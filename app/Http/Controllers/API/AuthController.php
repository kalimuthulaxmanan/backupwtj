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
use Storage;
use App\Http\Controllers\ImportExcelDataController;
use App\Http\Controllers\ValidateExcelDataController;
use App\Http\Controllers\PdfController;
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
				$data=$request->json()->all();
		
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
		$data=$request->json()->all();
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
		
	//	$staticPath=env('TEMP_UPLOAD_PATH').'';

		   $filename=explode("/",$data['file_name']);
		 
		   foreach($filename as $filenames){
		    $data['file_name']=$filenames;
		   }

        $url= Storage::disk('s3')->url($data['file_name']);

        try {
            fopen($url, 'r');
        }
        catch (\Exception $e){
            return response()->json(['Error'=>'File not available in S3 bucket.'],422);
        }
		
		
		 $user = DB::table('users')->where('email', $data['client_name'])->first();
		$returnDirData=$this->recurse_copy('uploads/',$data['file_name']);
		
		if($user)
		{
			$data=['user_id'=>$user->id,'upload_path'=>$returnDirData['upload_path'],'upload_file'=>$data['file_name'],'file_name'=>$returnDirData['file_name'],'status'=>0,'created_at'=>date('Y-m-d H:i:s')];
			$status=DB::table('files_directory')->insertGetId($data);
				
			 $datastatus=$this->callBackgroundUrl();
			if(is_array($datastatus))
			 {
			 $i=1;
			 $errormsg='please correct the following errors and try again <br />';	 
			 foreach($datastatus as $datastatuss)
			 { 
			 $errormsg.=$i.'. '.$datastatuss."<br />";
			 $i++;
			 }
			 DB::table('files_directory')->where('id',$status)->delete(); 
			 return response()->json(['Invaildfile'=>$errormsg],405);	 
			 }
		     if($datastatus== 'invalidfile'){
				DB::table('files_directory')->where('id',$status)->delete(); 
			 return response()->json(['Invaildfile'=>'Some of the arguments in data sheet are invalid. Please correct it and try again.'],405);
			 }
				 	
		
			return response()->json(['Success'=>'Data submission success'],200);
		}
		else
		{
			
			
			$dataImport=['email'=>$data['client_name'],'role_id'=>1];
			$status=DB::table('users')->insertGetId($dataImport);
			$filedata=['user_id'=>$status,'upload_path'=>$returnDirData['upload_path'],'upload_file'=>$data['file_name'],'file_name'=>$returnDirData['file_name'],'status'=>0,'created_at'=>date('Y-m-d H:i:s')];

			$status=DB::table('files_directory')->insertGetId($filedata);
			
			 $datastatus=$this->callBackgroundUrl();
			 if(is_array($datastatus))
			 {
			 $i=1;
			 $errormsg='please correct the following errors and try again <br />';	 
			 foreach($datastatus as $datastatuss)
			 { 
			 $errormsg.=$i.'. '.$datastatuss."<br />";
			 $i++;
			 }
			 DB::table('files_directory')->where('id',$status)->delete(); 
			 return response()->json(['Invaildfile'=>$errormsg],405);	 
			 }
		     if($datastatus== 'invalidfile'){
			 DB::table('files_directory')->where('id',$status)->delete(); 	 
			 return response()->json(['Invaildfile'=>'Some of the arguments in data sheet are invalid. Please correct it and try again.'],405);
			 }
			 
	
			return response()->json(['Success'=>'Data submission success'],200);
		}
		

		
	}
	
	private function callBackgroundUrl()
	{
		
		
		$importdata=DB::table('files_directory')->where('status', 0)->get();
		//print_r(file_get_contents('http://kenhike.com//robots.txt'));
		
		foreach($importdata as $key=>$value)
		{  
			
			$ValidateExcelData=new ValidateExcelDataController();
		    try{
			$errors=$ValidateExcelData->importExcel($value);
			$errors = array_filter($errors);	
			if (!empty($errors)) {
            return $errors; 
			}	
			}catch(\Exception $e){	
			 return 'invalidfile';
			}
				
			
			$ImportExcelData=new ImportExcelDataController();
		    try{
			$ImportExcelData->importExcel($value);
			
			}catch(\Exception $e){
			  
			 return 'invalidfile';
			} 	  
			 
			DB::table('files_directory')->where('id', $value->id)->update(array('status' => 1));
		
			
		}
		
		/*	$url=url('backgroundWork'); //die;
			//echo $url;die;
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL, $url);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_TIMEOUT,2);
			$buffer = curl_exec($curl_handle);
			//	$httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
			curl_close($curl_handle); */
		
	}
	
	private function downloadZipFiles($directoryName,$dst,$fileName)
	{
        $url= Storage::disk('s3')->url($fileName);

        try {
            file_put_contents($dst . $directoryName . '/' . $directoryName . ".zip", fopen($url, 'r'));
        } catch (\Exception $e){
            return response()->json(['Error'=>'File not available in S3 bucket.'],422);
        }
//        $exists = Storage::disk('s3')->exists($fileName);
//		if($exists)
//		{
//		  $contents = Storage::disk('s3')->get($fileName);
//
//		file_put_contents($dst.$directoryName.'/'.$directoryName.".zip",$contents);
//		}

		
		//return true;
		//dd($contents);
		
		//header("Content-type: application/zip");
		//header("Content-Disposition: attachment; filename=".$directoryName.".zip");
		//echo $contents;
		
	/*	$headers = [
    'Content-Type' => 'application/zip', 
    'Content-Description' => 'File Transfer',
    'Content-Disposition' => "attachment; filename=".$directoryName.".zip",
    'filename'=> $directoryName.".zip"
];

 response($contents, 200, $headers);*/


	}
	
	function recurse_copy($dst,$fileName) { 
		
		$directoryName=strtotime(date('Y-m-d H:i:s'));
		$result = File::makeDirectory($dst.$directoryName, 0777, true);

		
		$this->downloadZipFiles($directoryName,$dst,$fileName);
		
		
		$destinationDir=$dst.$directoryName;

		$src=$dst.$directoryName.'/'.$directoryName.".zip"; //die;
		$zip = new ZipArchive;
if ($zip->open($src) === TRUE) {
    $returnDatas=$zip->extractTo($destinationDir);
	//dd($returnDatas);
    $zip->close();
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
