<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use DB;
class testController extends Controller
{
	
	public function test($filename,$id){
		$publicpath=public_path();
        $pdfName=$publicpath.'/pdf/'.$filename.'.pdf';
		$pdfDir=$publicpath.'/pdf/'.$filename;
	    $pdfName=$publicpath.'/pdf/'.$filename.'.pdf';
		$pdfDir=$publicpath.'/pdf/'.$filename;
		if(file_exists($pdfName)){
		if (!file_exists($pdfDir) && !is_dir($pdfDir)) {
			 $result = File::makeDirectory($pdfDir, 0777, true);
			 DB::table('files_directory')
            ->where('id', $id)
            ->update(['flip_book_name' => '1']);	
			}else{
			 $result=$this->deleteDirectory($pdfDir);
			 $result = File::makeDirectory($pdfDir, 0777, true);
			 DB::table('files_directory')
            ->where('id', $id)
            ->update(['flip_book_name' => '1']);	
			}
			$pdf = new \Spatie\PdfToImage\Pdf($pdfName);
		    $pages=$pdf->getNumberOfPages();
			for($i=1;$i<=$pages;$i++){	
			$pdf->setPage($i)->saveImage($pdfDir.'/'.$i);
			}	
	/*$dir = "/var/www/html/backupwtj/public/pdfimages";
    $dh  = opendir($dir);
    while (false !== ($filename = readdir($dh))) {
      $files[] = $filename;
    } */
	//dd($files);	
		
    /*$pdf = new \Spatie\PdfToImage\Pdf('/home/kenhiket430/Pictures/var/MzM1.pdf');
	$pages=$pdf->getNumberOfPages();
	$result = File::makeDirectory('/home/kenhiket430/Pictures/var/MzM1/', 0777, true);	
	//dd($pdf);	
	for($i=1;$i<=$pages;$i++){	
	$pdf->setPage($i)
    ->saveImage('/home/kenhiket430/Pictures/var/'.$i);
	}
	dd($pdf);	*/
	}
		return "Images are created";
}
public function deleteDirectory($dirname){
	 if (is_dir($dirname))
           $dir_handle = opendir($dirname);
	 if (!$dir_handle)
	      return false;
	 while($file = readdir($dir_handle)) {
	       if ($file != "." && $file != "..") {
	            if (!is_dir($dirname."/".$file))
	                 unlink($dirname."/".$file);
	            else
	                 delete_directory($dirname.'/'.$file);
	       }
	 }
	 closedir($dir_handle);
	 rmdir($dirname);
	 return true;
	}	
}
