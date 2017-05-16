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
		
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

$filler = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. '
        . 'Nulla fermentum, tortor id adipiscing adipiscing, tortor turpis commodo. '
        . 'Donec vulputate iaculis metus, vel luctus dolor hendrerit ac. '
        . 'Suspendisse congue congue leo sed pellentesque.';
// Normal
$section = $phpWord->addSection();
$section->addText("Normal paragraph. {$filler}");
// Two columns
$section = $phpWord->addSection(
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
		
		
		
		
		
		

		
// Saving the document as HTML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
$objWriter->save('helloWorld.doc');die;
		
		
	}

   

}
