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
use Session;
use Illuminate\Http\Request;
use StaticMap;

use App\Http\Requests;

class FlipbookDataController extends BaseController
{
	
	public function fetchFlipData(Request $request)
	{
		$data=$request->all();
		
		$summarycount = DB::table('files_directory')
							->join('pdf_content', 'files_directory.id', '=', 'pdf_content.file_id')
							->join('pdf_common_fields', 'files_directory.id', '=', 'pdf_common_fields.file_id')
							->where([['files_directory.id',$data['userId']],['show_summery',1]])->count();
		$loopcount=round($summarycount/10);
		$mul=$loopcount*2;
		$pagediv=$mul-1+2;
		//$pagediv=$loopcount*2;
		$pagno=$loopcount-1;
		session(['pageadd' => $pagno]);
		if($data['page']<=$pagediv)
		{
			$page=1;
		}
		else
		{   $mulpage=$loopcount*2;
		    session(['pageadd' => $mulpage]);
			$page=$data['page']-$mulpage;
		}
		
		$dataSql = DB::table('files_directory')
            ->join('pdf_content', 'files_directory.id', '=', 'pdf_content.file_id')
            ->join('pdf_common_fields', 'files_directory.id', '=', 'pdf_common_fields.file_id')
			->join('pdf_templates', 'pdf_templates.id', '=', 'pdf_content.template_id')
            ->select('files_directory.*', 'pdf_common_fields.*', 'pdf_content.*', 'pdf_templates.name')
			->orderby('pdf_content.content_order','asc')
			->where('files_directory.id',$data['userId'])
			->where('pdf_content.content_order',$page)

            ->get();
	
		$appendData="";
		
		//dd($data);
		
		if(!empty($dataSql))
		{  
			foreach($dataSql as $key=>$value)
			{
				switch($value->name)
				{
					case "front_page":
                        $frontImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get(); 
                        $value->frontImages= $frontImages;

						if($data['page']==1 )
						{    $value->page= $data['page'];
						
							$appendData=$this->loadTemplate('frontpage',$value);
						}
						elseif($data['page']==2)
						{   $value->page= $data['page'];
							$appendData=$this->loadTemplate('emptypage',$value);
						}
						else
						{
						$i=$data['page']-1-3;
						$s=$i*10;	
						$summarydata = DB::table('files_directory')
							->join('pdf_content', 'files_directory.id', '=', 'pdf_content.file_id')
							->join('pdf_common_fields', 'files_directory.id', '=', 'pdf_common_fields.file_id')
							->where([['files_directory.id',$data['userId']],['show_summery',1]])->orderby('pdf_content.content_order','asc')->skip($s)->take(10)->get();	
							
							$value->page= $data['page']; 
							if($data['page']==3){
							$appendData=$this->loadTemplate('summarypage',$value,$summarydata);	
							}else{
							if ($data['page'] % 2 != 0) {	
							$appendData=$this->loadTemplate('summarypageext',$value,$summarydata);
							}else{
							  $value->page= $data['page'];
							  $appendData=$this->loadTemplate('emptypage',$value);
							}
								
							}	
							
						}
                     
						

						//	
						//
						
					break;	

					case "itinerary":
						    $itineraryImagescount=DB::table('pdf_content_images')->where('content_id',$value->id)->count();
						   $imagecount=$itineraryImagescount/5;
						   $itineraryDatacount=DB::table('pdf_itinenary')->where('content_id',$value->id)->count();
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
						   $value->page= $data['page'];		
						   $appendData.=$this->loadTemplate('itinerary',$value);
								
							}
					
						   }
						   
					break;
					case "detail_itinerary":
						    $detailitineraryImagescount=DB::table('pdf_content_images')->where('content_id',$value->id)->count();
						    $detailitineraryDatascount=DB::table('pdf_itinenary_details')->where('content_id',$value->id)->count();
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
							$value->page= $data['page'];			  
						    $appendData.=$this->loadTemplate('detailitinerary',$value);
								 }
			                   }
						    
					break;	
				    case "image_with_content":
						   $contentImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get();
						   $value->contentImages= $contentImages;
				           $value->page= $data['page'];
						   $appendData=$this->loadTemplate('titleleftimagecontentpage',$value);							
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
						 
						    $value->page= $data['page'];
						  
							$appendData=$this->loadTemplate('mapimage',$value);							
					break;	
				    case "travel_agent":
						    $travel_agent=DB::table('pdf_travel_agent')->where('content_id',$value->id)->select('name','profile_image','logo','place','additional_logo','footer_sign')->get();
						    $value->travel_agent=$travel_agent; 
						    $value->page= $data['page'];
							$appendData=$this->loadTemplate('travelagentpage',$value);
						   
					break;
					case "full_image_page":
						 $fullImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get();
						 $value->fullImages= $fullImages;
				         $value->page= $data['page'];
						$appendData=$this->loadTemplate('fullimagepage',$value);							
					break;
					case "empty_page":
						    $value->page= $data['page'];
							$appendData=$this->loadTemplate('emptypage_background',$value);							
					break;	
					case "content_only":
						    $value->page= $data['page'];
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
						    $value->page= $data['page'];
							$appendData=$this->loadTemplate('empty_page_with_title',$value);							
					break;	


						
				}
				
			}
			
		}
		
		//dd($request->all());
		//dd(Session::all());die;
		//echo "hai";
		//view('layouts.html.'.$template,['data'=>$data])->render();
				
		//dd($returndata);
		echo $appendData;
		//return view('flip.html.page'.$data['page']);
	}
	
	private function loadTemplate($template,$data,$data1=null)
	{
		//$returndata=view('flip.pages.page'.$data['page'])->render();
		$returndata=view('flip.pages.'.$template,['data'=>$data,'data1'=>$data1])->render();
		//dd($returndata);
		return $returndata;
		
	}
	
	
	function decodeUrlData($id)
	{
		return base64_decode($id);
	}
	
	public function flipbook($id)
	{   try{
		$id=$this->decodeUrlData($id);
		$filepage = DB::table('pdf_content')->where('file_id',$id)->count();
		$summarycount = DB::table('files_directory')
							->join('pdf_content', 'files_directory.id', '=', 'pdf_content.file_id')
							->join('pdf_common_fields', 'files_directory.id', '=', 'pdf_common_fields.file_id')
							->where([['files_directory.id',$id],['show_summery',1]])->count();
		$loopcount=round($summarycount/10);
		$muli=$loopcount*2;
		$filepagesCount=$filepage+$muli;
		if($filepagesCount%2==0)
		{
		$filepagesCount=$filepagesCount;	
		}
		else
		{
	    $filepagesCount=$filepagesCount+1;
		}
		
		//dd($request->all());
		//dd(Session::all());die;
		//echo "hai";
		return view('flip.flipbook',['id'=>$id,'filepagesCount'=>$filepagesCount]);
	}
	 catch(\Exception $e){
	    $errorMessage="Unable to generate document, Because invalid arguments or invalid image names";
		return Redirect::back()->withErrors(['message', "$errorMessage"]);
	 }
	}
	public  function flipURL($name){
	    $name=$name.'.zip';
        $fileid=DB::table('files_directory')->where('upload_file',$name)->orderBy('id','desc')->first();
        $id=base64_encode($fileid->id);
        return redirect("flipbook/$id");
    }
	
	
}
	