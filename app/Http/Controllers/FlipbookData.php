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
class FlipbookData extends BaseController
{
	
	public function flipbook()
	{
		return view('flip.flipbook');
	}
	
	
}
	