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
use StaticMap;

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
	
	public function generateHtmlPreview($id)
	{
		
		$data = DB::table('files_directory')
            ->join('pdf_content', 'files_directory.id', '=', 'pdf_content.file_id')
            ->join('pdf_common_fields', 'files_directory.id', '=', 'pdf_common_fields.file_id')
			->join('pdf_templates', 'pdf_templates.id', '=', 'pdf_content.template_id')
            ->select('files_directory.*', 'pdf_common_fields.*', 'pdf_content.*', 'pdf_templates.name')
			->orderby('pdf_content.content_order','asc')
						->where('files_directory.id',$id)

            ->get();
	
		$appendData="";
		
		if(!empty($data))
		{
			foreach($data as $key=>$value)
			{
				switch($value->name)
				{
					case "front_page":
                        $frontImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get(); 
                        $value->frontImages=  $frontImages;
                     
						$appendData.=$this->loadTemplate('frontpage',$value);

						$appendData.=$this->loadTemplate('emptypage',$value);	
						$appendData.=$this->loadTemplate('summarypage',$value);	
						
					break;	

					case "itinerary":
						   $itineraryData=DB::table('pdf_itinenary')->where('content_id',$value->id)->select('event_date','description')->get();
						   $value->itineraryData=$itineraryData;
						   $itineraryImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get(); 
						   $value->itineraryImages= $itineraryImages;
						   
						   $appendData.=$this->loadTemplate('itinerary',$value);
						   
					break;
					case "detail_itinerary":
						    $detailitineraryDatas=DB::table('pdf_itinenary_details')->where('content_id',$value->id)->select('event_date','description')->get();
						    $value->detailitineraryDatas=$detailitineraryDatas; 
						    $detailitineraryImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get(); 
						    $value->detailitineraryImages=$detailitineraryImages;
						
						 	$appendData.=$this->loadTemplate('detailitinerary',$value);	
					
						    
					break;	
				    case "image_with_content":
						   $contentImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get();
						   $value->contentImages= $contentImages;
				
						   $appendData.=$this->loadTemplate('titleleftimagecontentpage',$value);							
					break;
					case "map":
						
						   $Mapdetails=DB::table('pdf_map')->select('lat','lon')->get();	
                           $i=0;
                           foreach($Mapdetails as $detail)
									{
									$i+=1;
									$markers[]=['center'=> "$detail->lat,$detail->lon",'label'=>"$i"];

									}
		  			        $Mapimage= StaticMap::GoogleWithImg('31.520605,35.127777', ['markers' => $markers,'zoom'=>'8','with' =>'640', 'height' =>'640' ]); 
			 	            $value->Mapimage=$Mapimage;
							$appendData.=$this->loadTemplate('mapimage',$value);							
					break;	
				    case "travel_agent":
						    $travel_agent=DB::table('pdf_travel_agent')->where('content_id',$value->id)->select('name','profile_image','logo','place')->get();
						    $value->travel_agent=$travel_agent; 
							$appendData.=$this->loadTemplate('travelagentpage',$value);
						   
					break;
					case "full_image_page":
						 $fullImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get();
						 $value->fullImages= $fullImages;
				
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
		
		$galleries = DB::table('pdf_content_images')
            ->join('pdf_content', 'pdf_content_images.content_id', '=', 'pdf_content.id')
            ->join('files_directory', 'files_directory.id', '=', 'pdf_content.file_id')
           // ->select('files_directory.*', 'pdf_common_fields.*', 'pdf_content.*', 'pdf_templates.name')
			->groupBy('pdf_content_images.image')
            ->get();
		//dd($galleries);
		
	//	$galleries=DB::table('pdf_content_images')->groupBy('image')->get();

        view()->share('galleries',$galleries);
		
		
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
