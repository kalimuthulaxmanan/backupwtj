<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use DB;
use StaticMap;

class DocController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     */
    public function __construct()
    {
		
		//dd(session('is_login'));
	
		   if(session('is_login')==false)
			{
				Redirect::to('login')->send();

			}
		

    }
	
	public function generateDoc($id)
	{
		
/*		$phpWord = new \PhpOffice\PhpWord\PhpWord();

/* Note: any element you append to a document must reside inside of a Section. */

 // Adding an empty Section to the document...
/*$section = $phpWord->addSection();

		
		$section->addImage('http://localhost/dev_wtj/public/uploads/1494940055/test/front_page_image.jpg',
    array(
        'width' => '650',
        'height' => '650',
        ));
		
		//$section->addTextBreak(['10'], '', '');

		$section->addTextBreak(5, null, null);

		

		
		//$section->addPageBreak();
		
		
		$section->addImage('http://localhost/dev_wtj/public/uploads/1494940055/test/front_page_image.jpg',
    array(
        'width' => '100',
        'height' => '100',
        ));
$section->addText('Text break with no style:');
$section->addText('Text break with no style:');


		
// Saving the document as HTML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
$objWriter->save('helloWorld.doc');die; */
		
$source='/var/www/html/dev_wtj/public/titleleftimagecontentpage.html';		
$phpWord = \PhpOffice\PhpWord\IOFactory::load($source, 'HTML');	
$phpWord->save('helloWorld.doc');
echo "document created";		
		
		
	}

   

}
