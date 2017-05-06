<?php

namespace App\Http\Controllers\API;

//use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use DB;
use ZipArchive;
use File;
class AuthController extends Controller
{ 
	
	public function validationInput($data,$param)
	{
		$error=[];

		
		foreach($param as $key=>$value)
		{
			if(!isset($data[$value]))
			{
				$error['error'][]="Request must contain ".$value." param";
				$error['status']=406;

			}
			
			
		}
		//dd($error);
		
		if(!empty($error))
		{
			return $error;
			
		}
		
		foreach($param as $key=>$value)
		{
			if($data[$value]=="")
			{
				$error['error'][]="".$value." can not be empty";
				$error['status']=422;

			}
			
		}
		
		return $error;
		
		
	}
	
	public function client_list(Request $request)
	{
				$data=$request->all();
		$param=['api_token'];

		$validationError=$this->validationInput($data,$param);
		
		if(!empty($validationError))
		{
			return response()->json(['msg'=>$validationError['error']],$validationError['status']);

		}
		
		
		
		if($data['api_token']!=env('API_TOKEN'))
		{
			return response()->json(['msg'=>'Invalid Auth token.'],401);

		}
		
			$pdflist = DB::table('users')->select('email as client_name','files_directory.upload_file as file_name','files_directory.created_at')
				->join('files_directory', 'files_directory.user_id', '=','users.id')->orderBy('files_directory.created_at', 'desc')->limit(5)->get(); 

			return ['list'=>$pdflist];
	}
 

	
	public function checkUser(Request $request)
	{
		

		//$this->saveRegister($request->all());
		$data=$request->all();
		$param=['client_name','api_token','file_name'];

		$validationError=$this->validationInput($data,$param);
		
		if(!empty($validationError))
		{
			return response()->json(['msg'=>$validationError['error']],$validationError['status']);

		}
		
		
		
		if($data['api_token']!=env('API_TOKEN'))
		{
			return response()->json(['msg'=>'Invalid Auth token.'],401);

		}
		
		$staticPath=env('TEMP_UPLOAD_PATH').$data['file_name'];
		
		
		
		 $user = DB::table('users')->where('email', $data['client_name'])->first();
		$returnDirData=$this->recurse_copy($staticPath,'uploads/');
		
		if($user)
		{
			$data=['user_id'=>$user->id,'upload_path'=>$returnDirData['upload_path'],'upload_file'=>$data['file_name'],'file_name'=>$returnDirData['file_name'],'status'=>0,'created_at'=>date('Y-m-d H:i:s')];
			$status=DB::table('files_directory')->insert($data);
			
			 $this->callBackgroundUrl();
			
			return response()->json(['Success'=>'Data submission success'],200);
		}
		else
		{
			
			
			$dataImport=['email'=>$data['client_name'],'role_id'=>2];
			$status=DB::table('users')->insertGetId($dataImport);
			$filedata=['user_id'=>$status,'upload_path'=>$returnDirData['upload_path'],'upload_file'=>$data['file_name'],'file_name'=>$returnDirData['file_name'],'status'=>0,'created_at'=>date('Y-m-d H:i:s')];

			$status=DB::table('files_directory')->insert($filedata);
			
			 $this->callBackgroundUrl();
			return response()->json(['Success'=>'Data submission success'],200);
		}
		

		
	}
	
	private function callBackgroundUrl()
	{
		
			$url=url('backgroundWork'); //die;
			//echo $url;die;
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL, $url);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_TIMEOUT,2);
			$buffer = curl_exec($curl_handle);
			//	$httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
			curl_close($curl_handle);
		
	}
	
	function recurse_copy($src,$dst) { 
		
		$directoryName=strtotime(date('Y-m-d H:i:s'));
		
		$result = File::makeDirectory($dst.$directoryName, 0777, true);
		
		$destinationDir=$dst.$directoryName;

		
		$zip = new ZipArchive;
if ($zip->open($src) === TRUE) {
    $returnDatas=$zip->extractTo($destinationDir);
	//dd($returnDatas);
    $zip->close();
} else {
    //echo "Fail to open";
}
		$SourcesFile="";
        $dir = opendir($destinationDir); 
        @mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
				if (( $file != '.' ) && ( $file != '..' )) { 
					if ( is_dir($destinationDir . '/' . $file) ) { 
						 $dir1 = opendir($destinationDir . '/' . $file); 
									while(false !== ( $file1 = readdir($dir1)) ) { 
								if (( $file1 != '.' ) && ( $file1 != '..' )) { 
									if ( is_dir($destinationDir . '/' . $file. '/' . $file1) ) { 
										//recurse_copy($src . '/' . $file,$dst . '/' . $file); 
									} 
									else { 
										
												//$extension = end(explode('.', $file1));
												$tmp = explode('.', $file1);
												$extension = end($tmp);
												//dd($file1);
												if($extension == 'cvs' || $extension == 'xls' || $extension == 'xlsx')
												{
												  $SourcesFile=$file1;
												}

										//copy($src . '/' . $file,$dst . '/' . $file); 
									} 
								} 

							 } 
						
						$destinationDir=$destinationDir . '/' . $file;
					} 
					else { 
						                       												//$extension = end(explode('.', $file1));
												$tmp = explode('.', $file);
												$extension = end($tmp);
												//dd($file1);

												if($extension == 'cvs' || $extension == 'xls' || $extension == 'xlsx')
												{
												  $SourcesFile=$file;
												}
					} 
				} 
				else
				{

					
				
			}
        } 
		
		return ['upload_path'=>$destinationDir.'/','file_name'=>$SourcesFile];
        //closedir($dir); 
    }
	
	


function fnDecrypt($sValue, $sSecretKey)
{
    return rtrim(
        mcrypt_decrypt(
            MCRYPT_RIJNDAEL_256, 
            $sSecretKey, 
            base64_decode($sValue), 
            MCRYPT_MODE_ECB,
            mcrypt_create_iv(
                mcrypt_get_iv_size(
                    MCRYPT_RIJNDAEL_256,
                    MCRYPT_MODE_ECB
                ), 
                MCRYPT_RAND
            )
        ), "\0"
    );
}
	

}
