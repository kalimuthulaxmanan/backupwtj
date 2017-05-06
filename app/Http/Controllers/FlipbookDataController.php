<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Response;
use Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Artisan;
use PHPExcel_IOFactory;
class FlipbookDataController extends BaseController
{
	
	public function flipbook($id)
	{
		//echo "hai";
		return view('flip.flipbook');
	}
	
	
}
	