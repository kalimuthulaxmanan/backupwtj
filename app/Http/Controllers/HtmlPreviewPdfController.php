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
		
//	dd($data);
	
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
						$appendData.=$this->loadTemplate('summarypage',$value,$data);	
						
					break;	

					case "itinerary":
						   
						   $itineraryImagescount=DB::table('pdf_content_images')->where('content_id',$value->id)->count();

						   $imagecount=$itineraryImagescount/5;
						   $itineraryDatacount=DB::table('pdf_itinenary')->where('content_id',$value->id)->count();
						   //dd($itineraryDatacount);
						   $Datacount=round($itineraryDatacount/$imagecount);
						   $j=0;
						   for($i=0;$i<=$itineraryImagescount;$i++)
						   {
						      
						   if($i%5==0 && $i<$itineraryImagescount )
							{ 
						   $itineraryData=DB::table('pdf_itinenary')->where('content_id',$value->id)->select('event_date','description')->skip($j)->take($Datacount)->get();	                 $j+=$Datacount;
						   $value->itineraryData=$itineraryData;	
						   $itineraryImages=DB::table('pdf_content_images')->where('content_id',$value->id)->skip($i)->take(5)->get();
						    
						   $value->itineraryImages= $itineraryImages;	
						   $appendData.=$this->loadTemplate('itinerary',$value);
								
							}
					
						   }
						
						
						  //$itineraryImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get();
						   //$value->itineraryImages= $itineraryImages;
						   
						   //$appendData.=$this->loadTemplate('itinerary',$value);
						   
					break;
					case "detail_itinerary":
						    
						    $detailitineraryImagescount=DB::table('pdf_content_images')->where('content_id',$value->id)->count();

						    $detailitineraryDatascount=DB::table('pdf_itinenary_details')->where('content_id',$value->id)->count();
						    //dd($detailitineraryDatascount);
						    $imagecount=$detailitineraryImagescount/5;
						    $Datacount=round($detailitineraryDatascount/$imagecount);
						    $j=0;
						    
						    for($i=0;$i<=$detailitineraryImagescount;$i++)
						        {
						      if($i%5==0 && $i<$detailitineraryImagescount)
							      {
							 $detailitineraryDatas=DB::table('pdf_itinenary_details')->where('content_id',$value->id)->select('event_date','description')->skip($j)->take($Datacount)->get(); $j+=$Datacount;
						    $value->detailitineraryDatas=$detailitineraryDatas;		  
						    $detailitineraryImages=DB::table('pdf_content_images')->where('content_id',$value->id)->skip($i)->take(5)->get();
						    $value->detailitineraryImages=$detailitineraryImages;	
						    $appendData.=$this->loadTemplate('detailitinerary',$value);
								 }
			                   }
						
						
						
						   // $detailitineraryImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get(); 
						
						    
						
						
						    //$value->detailitineraryImages=$detailitineraryImages;
						
						 	//$appendData.=$this->loadTemplate('detailitinerary',$value);	
					
						    
					break;	
				    case "image_with_content":

						   $contentImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get();
						   $value->contentImages= $contentImages;
				           if($value->itinerary_date_with_title=="" || $value->itinerary_date_with_title==null)
				           {
				           	$appendData.=$this->loadTemplate('leftimagecontentpage',$value);
				           }
				           else{      
						   $appendData.=$this->loadTemplate('titleleftimagecontentpage',$value);						
						   }	
					break;
					case "map":
						   
						   $Mapdetails=DB::table('pdf_map')->where('file_id',$value->file_id)->select('lat','lon')->get();	
                           $i=0;
                           foreach($Mapdetails as $detail)
									{
									$i+=1;
									$markers[]=['center'=> "$detail->lat,$detail->lon",'label'=>"$i"];

									}
		  			        $Mapimage= StaticMap::GoogleWithImg("$detail->lat,$detail->lon", ['markers' => $markers,'zoom'=>'8','with' =>'640', 'height' =>'640' ]); 
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
					        $title="$value->title";
						    		  
						    if(strpos($title,"and terms")==null)
							{
							
							$appendData.=$this->loadTemplate('toptitlecontent_only',$value); 
							
							}
						    else
							{
							$appendData.=$this->loadTemplate('content_only',$value);
							}
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
		
		
		//dd($galleries);
		
	//	$galleries=DB::table('pdf_content_images')->groupBy('image')->get();
      
$galleries = DB::table('files_directory')
            ->join('pdf_content', 'pdf_content.file_id', '=', 'files_directory.id')
            ->join('pdf_content_images', 'pdf_content_images.content_id', '=', 'pdf_content.id')
           // ->select('files_directory.*', 'pdf_common_fields.*', 'pdf_content.*', 'pdf_templates.name')
			->groupBy('pdf_content_images.image')
            ->get();
		
//$gelleryphoto[]=array('image'=>"",'path'=>"");
		
    /* $image=array();
	   foreach($galleries as $gallery)
	   {
	    if(array_key_exists("$gallery->image",$image))
		{
		}
	   else
	   {
		
   $image[]=array('image'=>$gallery->image,'path'=>$gallery->upload_path);
		  
   $galimage =new \stdClass();
	  
   $galimage->image=$image;   
		
	   }
	   }
	/*foreach($galimage->image as $galimagesss)
		{
		dd($galimagesss['path']);
		}
	   dd($galimage->image ); 
	   dd($galleryimages);	*/
	
		
		$uploadpath=$value->upload_path;
	    
		/*foreach($galleries as $gallery)
		{
		$fileid=$gallery->file_id;
		}*/
		
	//	dd($galleries);
		
		
	//	echo $fileid; die;
		
        view()->share('galleries',$galleries);
		//view()->share('galimage',$galimage);
		
		
		
		return view('pdf.htmlview',['data'=>$appendData,'uploadpath'=>$uploadpath,'fileid'=>$id]);

		
		//dd($data);
		

		
	}
	
	private function loadTemplate($template,$data,$data1=null)
	{
		
		$returndata=view('layouts.html.'.$template,['data'=>$data,'data1'=>$data1])->render();
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
