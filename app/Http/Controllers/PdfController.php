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
	$id=base64_decode($id);
	
	$content=DB::table('pdf_content')->where('file_id',$id)->select('id')->get();
	foreach($content as $contents) 
	{
	 $content_id=$contents->id;		
	 DB::table('pdf_content_images')->where('content_id',$content_id)->delete();
	}

$list=DB::table('files_directory')->where('id',$id)->delete();
      DB::table('pdf_common_fields')->where('file_id',$id)->delete();
	  DB::table('pdf_content')->where('file_id',$id)->delete();
	 DB::table('pdf_itinenary')->where('file_id',$id)->delete();
	 DB::table('pdf_itinenary_details')->where('file_id',$id)->delete();
	 DB::table('pdf_map')->where('file_id',$id)->delete();
	 DB::table('pdf_travel_agent')->where('file_id',$id)->delete();

  
session()->flash('deletesucessfull', 'filedelete');
return back();



}


public function test()
{

return view('test');
}
	
public function changeimage($id,Request $request)
{
   $imageid=$request->input('file_path');
   $changeimg=DB::table('pdf_content_images')
                            ->where('id', $imageid)
	                        ->select('image')
                            ->get();
	foreach($changeimg as $changeimgs )
	{
	$img= $changeimgs->image;
	}
  	
	
	DB::table('pdf_content_images')
                            ->where('id', $id)
                            ->update(['image'=>$img]);


 echo "sucessfully updated";

}	

public function galleryupload($id,Request $request)
	{
		
  	   
		$uploadpath=$request->input('uploadpath');
	
		
	    $FileTemp = $_FILES['image']['tmp_name'];
	    $FileName = $_FILES['image']['name'];
	    $FileType = $_FILES['image']['type'];
	
		$FilePath = public_path($uploadpath).$FileName;
		$image=$uploadpath.$FileName;
	
	 
       
	    DB::table('pdf_content_images')
                            ->where('id', $id)
                            ->update(['image'=>$image]);

	    move_uploaded_file($FileTemp, $FilePath);
	


	


	}
	
	
	
}