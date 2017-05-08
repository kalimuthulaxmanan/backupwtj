<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use Validator;
use DB;
use App;
use PDF;
use Dompdf\Dompdf;
use Response;
//use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Anam\PhantomMagick\Converter;
use GoogleMaps;
use StaticMap;
use Mapper;
class PdfController extends Controller
{
 
public function __construct()
    {
	//$sessionData=Session::all();
	//	dd($sessionData);
		   if(session('is_login')==false)
			{
				Redirect::to('login')->send();

			}
		

    }
public function pdflist()
{
/*list the all files */

	$pdflist = DB::table('users')
            ->join('files_directory', 'files_directory.user_id', '=','users.id')->get(); 

return view('pdflist',['pdflist'=>$pdflist]);
}
public function fileGenerate()
{
Mapper::map(53.381128999999990000, -1.470085000000040000);	
$map=Mapper::render();
	
return view('generate',['map'=>$map]);


}
public function generate()
{
return view('htmlview');
}
public function fileview()
{
return view('fileview');
}	
public function download()
          { 

			  
			  $image= StaticMap::GoogleWithLink('53.381128999999990000, -1.470085000000040000', ['markers' => true,'with' =>'640', 'height' =>'640' ]) ;

			 view()->share('image',$image);
			 return  $pdf = PDF::loadView('layout')->stream();
             
			 
		
          }
public function word()	
{

 
    /*$file = View('layout');
     $response = Response::make($file, 200);
    // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
     $response->header('Content-Type', 'application/msword');
     $response->header('Content-Disposition', 'attachment; filename="myfile.docx"');
     return $response;*/

}
public function listdelete($id)
{
	
$list=DB::table('files_directory')->where('id',$id)->delete();
  
session()->flash('deletesucessfull', 'filedelete');
return back();



}


public function test()
{


Converter::make('/var/www/html/map/resources/views/layout1.html')
    ->toPdf()
    ->download('google.pdf');
}
	
public function changeimage($id,$image)
{

	DB::table('pdf_content_images')
                            ->where('id', $id)
                            ->update(['image'=>$image]);


 echo "sucessfully updated";

}	

public function galleryupload($id,Request $request)
	{
  	    $data=$request->all();
        
	    $FileTemp = $_FILES['image']['tmp_name'];
	    $FileName = $_FILES['image']['name'];
	    $FileType = $_FILES['image']['type'];
	    $FilePath = base_path('public/uploads/').$FileName;
	    $path='/'.config('app.name').'/public/uploads/'.$FileName;
	    
       
	    DB::table('pdf_content_images')
                            ->where('id', $id)
                            ->update(['image'=>$FileName]);

	move_uploaded_file($FileTemp, $FilePath);
	

  echo   "$('#'+x).attr('src','uploads/'.$FileName)";
	


	}
	
	
	
}