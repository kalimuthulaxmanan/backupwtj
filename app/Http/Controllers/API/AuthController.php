<?php

namespace App\Http\Controllers\API;

//use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use DB;
class AuthController extends Controller
{ 
 

	
	public function checkUser(Request $request)
	{
		$v=Validator::make($request->all(), [
            'client_name' => 'required',
            'api_token' => 'required|min:6',
			'file_name' => 'required|min:6',
			'image_path' => 'required|min:6',
        ]);
		if ($v->fails())
		{	
			return response()->json($v->errors());

		}


		//$this->saveRegister($request->all());
		$data=$request->all();
		
		if($data['api_token']!=env('API_TOKEN'))
		{
			return response()->json(['Error'=>'Invalid user.'],300);

		}
		
		 $user = DB::table('users')->where('email', $data['client_name'])->first();
		$this->recurse_copy($data['image_path'],'uploads/');
		
		//dd($user);
		if($user)
		{
			$data=['user_id'=>$user->id,'file_path'=>$data['image_path'],'file_name'=>$data['file_name'],'status'=>0,'created_at'=>date('Y-m-d H:i:s')];
			$status=DB::table('files_directory')->insert($data);
			
			 $this->callBackgroundUrl();
			
			return response()->json(['Success'=>'User has imported successfully'],200);
		}
		else
		{
			
			
			$dataImport=['email'=>$data['client_name'],'role_id'=>2];
			$status=DB::table('users')->insertGetId($dataImport);
			$filedata=['user_id'=>$status,'file_path'=>$data['image_path'],'file_name'=>$data['file_name'],'status'=>0,'created_at'=>date('Y-m-d H:i:s')];

			$status=DB::table('files_directory')->insert($filedata);
			
			 $this->callBackgroundUrl();
			return response()->json(['Success'=>'User has imported successfully'],200);
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
        $dir = opendir($src); 
        @mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        closedir($dir); 
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
