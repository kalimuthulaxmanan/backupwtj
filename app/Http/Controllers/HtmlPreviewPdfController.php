<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use Validator;
use DB;
use View;

class HtmlPreviewPdfController extends Controller
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
	
	public function generateHtmlPreview()
	{
		
		$data = DB::table('files_directory')
            ->join('pdf_content', 'files_directory.id', '=', 'pdf_content.file_id')
            ->join('pdf_common_fields', 'files_directory.id', '=', 'pdf_common_fields.file_id')
			->join('pdf_templates', 'pdf_templates.id', '=', 'pdf_content.template_id')
            ->select('files_directory.*', 'pdf_common_fields.*', 'pdf_content.*', 'pdf_templates.name')
			->orderby('pdf_content.content_order','asc')
            ->get();
		
		$appendData="";
		
		if(!empty($data))
		{
			foreach($data as $key=>$value)
			{
				switch($value->name)
				{
					case "front_page":
						//dd($value);
							$appendData.=$this->loadTemplate('frontpage',$value);	
						$appendData.=$this->loadTemplate('emptypage',$value);	
						$appendData.=$this->loadTemplate('summarypage',$value);	
					break;	

					case "itinerary":
							$appendData.=$this->loadTemplate('itinerary',$value);							
					break;
					case "detail_itinerary":
							$appendData.=$this->loadTemplate('detailitinerary',$value);							
					break;	
				    case "image_with_content":
							$appendData.=$this->loadTemplate('image_with_content',$value);							
					break;
					case "map":
							$appendData.=$this->loadTemplate('detailitinerary',$value);							
					break;	
				    case "travel_agent":
							$appendData.=$this->loadTemplate('travelagentpage',$value);							
					break;
					case "full_image_page":
							$appendData.=$this->loadTemplate('fullimagepage',$value);							
					break;
					case "empty_page":
							$appendData.=$this->loadTemplate('emptypage_background',$value);							
					break;	
					case "content_only":
							$appendData.=$this->loadTemplate('content_only',$value);							
					break;	
						case "empty_page_with_title":
							$appendData.=$this->loadTemplate('empty_page_with_title',$value);							
					break;	


						
				}
				
			}
			
		}
		else
		{
			
		}
		
		
		return view('pdf.htmlview',['data'=>$appendData]);

		
		//dd($data);
		

		
	}
	
	private function loadTemplate($template,$data)
	{
		
		$returndata=view('layouts.html.'.$template,['data'=>$data])->render();
		//dd($returndata);
		return $returndata;
		
	}

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
   

}
