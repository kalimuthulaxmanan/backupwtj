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

<<<<<<< HEAD
/* Note: any element you append to a document must reside inside of a Section. */

 // Adding an empty Section to the document...
/*$section = $phpWord->addSection();

		
		$section->addImage('http://localhost/dev_wtj/public/uploads/1494940055/test/front_page_image.jpg',
=======
$filler = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. '
        . 'Nulla fermentum, tortor id adipiscing adipiscing, tortor turpis commodo. '
        . 'Donec vulputate iaculis metus, vel luctus dolor hendrerit ac. '
        . 'Suspendisse congue congue leo sed pellentesque.';
// Normal
$section = $phpWord->addSection();
$section->addText("Normal paragraph. {$filler}");
// Two columns
$section = $phpWord->addSection(
>>>>>>> fb9169d1875fd400b73fc9f73f70dd121914cffc
    array(
        'colsNum'   => 2,
        'colsSpace' => 1440,
        'breakType' => 'continuous',
    )
);
$section->addText("Two columns, one inch (1440 twips) spacing. {$filler}");
// Normal
$section = $phpWord->addSection(array('breakType' => 'continuous'));
$section->addText("Normal paragraph again. {$filler}");
// Three columns
$section = $phpWord->addSection(
    array(
        'colsNum'   => 3,
        'colsSpace' => 720,
        'breakType' => 'continuous',
    )
);
$section->addText("Three columns, half inch (720 twips) spacing. {$filler}");
// Normal
$section = $phpWord->addSection(array('breakType' => 'continuous'));
$section->addText("Normal paragraph again. {$filler}");
		
		
		
		
		
		
<<<<<<< HEAD
		$section->addImage('http://localhost/dev_wtj/public/uploads/1494940055/test/front_page_image.jpg',
    array(
        'width' => '100',
        'height' => '100',
        ));
$section->addText('Text break with no style:');
$section->addText('Text break with no style:');

=======
>>>>>>> fb9169d1875fd400b73fc9f73f70dd121914cffc

		
// Saving the document as HTML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
$objWriter->save('helloWorld.doc');die; */
		
$source='/var/www/html/dev_wtj/public/titleleftimagecontentpage.html';		
$phpWord = \PhpOffice\PhpWord\IOFactory::load($source, 'HTML');	
$phpWord->save('helloWorld.doc');
echo "document created";		
		
		
	}

   

}
