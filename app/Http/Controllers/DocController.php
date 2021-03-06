<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use DB;
use StaticMap;
use Response;
use Sunra\PhpSimple\HtmlDomParser;

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
	 	
	try{
/*$data = DB::table('files_directory')
            ->join('pdf_content', 'files_directory.id', '=', 'pdf_content.file_id')
            ->join('pdf_common_fields', 'files_directory.id', '=', 'pdf_common_fields.file_id')
			->join('pdf_templates', 'pdf_templates.id', '=', 'pdf_content.template_id')
            ->select('files_directory.*', 'pdf_common_fields.*', 'pdf_content.*', 'pdf_templates.name')
			->where('files_directory.id',$id)
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
						    $appendData.=$this->loadTemplate('detailitinerary',$value);
								 }
			                   }
					
						    
					break;	
				    case "image_with_content":
						   $contentImages=DB::table('pdf_content_images')->where('content_id',$value->id)->select('image')->get();
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
						 $fullImages=DB::table('pdf_content_images')->where('content_id',$value->id)->select('image')->get();
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
     		 
      //return view('pdf.wordview',['data'=>$appendData]);

		//dd($appendData);
		//return  PDF::loadView('pdf.pdfview',['data'=>$appendData])->stream();
			$html= view('pdf.wordview',['data'=>$appendData])->render(); 
	
			
		 $filename=$value->upload_file;
		//return view('pdf.pdfview',['data'=>$appendData]);
		   $dot=strrpos($filename,'.');
		   $file=substr($filename,0,$dot); 
			   
		
		//substr
             
		header("Content-type: application/msword");
        header("Content-Disposition: attachment;Filename= $file.doc");

echo $html; 
		//dd($data);
		

	}
	
	
	private function loadTemplate($template,$data,$data1=null)
	{
		
		$returndata=view('layouts.word.'.$template,['data'=>$data,'data1'=>$data1])->render();
		//dd($returndata);
		return $returndata;
		
	} */

   

	/**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
  
$phpWord = new \PhpOffice\PhpWord\PhpWord();
				
$data = DB::table('files_directory')
            ->join('pdf_content', 'files_directory.id', '=', 'pdf_content.file_id')
            ->join('pdf_common_fields', 'files_directory.id', '=', 'pdf_common_fields.file_id')
			->join('pdf_templates', 'pdf_templates.id', '=', 'pdf_content.template_id')
            ->select('files_directory.*', 'pdf_common_fields.*', 'pdf_content.*', 'pdf_templates.name')
			->where('files_directory.id',base64_decode($id))
			->orderby('pdf_content.content_order','asc')
            ->get();		
		
if(!empty($data))
		{
			foreach($data as $key=>$value)
			{
switch($value->name)
	
	{
  case "front_page":
			
	$frontImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get(); 
    $value->frontImages=  $frontImages;
	$this->frontpage($phpWord,$value);	
	$this->logopage($phpWord,$value);
	$this->summerypage($phpWord,$value,$data);		
	break;			
	
 case "itinerary":
	$itineraryData=DB::table('pdf_itinenary')->where('content_id',$value->id)->get();			
	$itineraryImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get();
	$value->itineraryData=$itineraryData;
	$value->itineraryImages=$itineraryImages;			
	$this->itinerary($phpWord,$value);
    break;
 case "detail_itinerary":
	$detailitineraryDatas=DB::table('pdf_itinenary_details')->where('content_id',$value->id)->get();
	$detailitineraryImages=DB::table('pdf_content_images')->where('content_id',$value->id)->get();		
	$value->detailitineraryDatas=$detailitineraryDatas;
    $value->detailitineraryImages=$detailitineraryImages;
	$this->detailed_itinary($phpWord,$value);
	break;
  case "image_with_content":
	$contentImages=DB::table('pdf_content_images')->where('content_id',$value->id)->select('image')->get();
	$value->contentImages= $contentImages;		
	if($value->itinerary_date_with_title=="" || $value->itinerary_date_with_title==null)
	   {
		$this->image_with_content($phpWord,$value);
	   }
	   else{      
	   		$this->itinary_image_with_content($phpWord,$value);				
	       }
	break;
  case "travel_agent":
	$travel_agent=DB::table('pdf_travel_agent')->where('content_id',$value->id)->select('name','profile_image','logo','place')->get();
	$value->travel_agent=$travel_agent; 
	$this->travalagent($phpWord,$value);					   
  break;	
	case "full_image_page":
		 $fullImages=DB::table('pdf_content_images')->where('content_id',$value->id)->select('image')->get();
		 $value->fullImages= $fullImages;
         $this->fullpage($phpWord,$value);							
	break;

	case "empty_page":
	  $this->emptypage($phpWord,$value);						
	  break;			
	case "empty_page_with_title":
	 $this->emptypagetitle($phpWord,$value);						
	break;		
	case "content_only":
	  $title="$value->title";
 
		if(strpos($title,"and terms")==null || strpos($title,"and terms")== true  )
		{
      
		$this->toptitlecontent($phpWord,$value);
		}
		else
		{
		$this->contentonly($phpWord,$value);
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
		$str ="$Mapimage";	
		$dom = HtmlDomParser::str_get_html( $str );	
		$elems = $dom->find('img');
		
		$map=$elems[0]->attr['src'];	
        $this->map($phpWord,$map);
							
break;		
	
	
	}
 				
	}
  }			
    /*$this->image_with_content($phpWord);
	$this->itinerary($phpWord);
	$this->detailed_itinary($phpWord);
	$this->frontpage($phpWord);
	$this->travalagent($phpWord);
	$this->fullpage($phpWord);
	$this->emptypage($phpWord);
	$this->contentonly($phpWord);
	$this->toptitlecontent($phpWord);	
	$this->summerypage($phpWord);	*/
		
		
		 $filename=$value->upload_file;
		//return view('pdf.pdfview',['data'=>$appendData]);
		   $dot=strrpos($filename,'.');
		   $file=substr($filename,0,$dot);
		$filename = "$file.docx";
		
header("Content-Description: File Transfer");
header( "Content-Type:   application/vnd.openxmlformats-officedocument.wordprocessingml.document" );// you should look for the real header that a word2007 document needs!!!
header('Content-Disposition: attachment; filename='.$filename );
	
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
		

$h2d_file_uri = tempnam( "", "htd" );
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
ob_clean();		
$objWriter->save( "php://output" );		
exit;		
		
		
		
/*    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
	$filename = "$file.docx";
	ob_clean();
    $objWriter->save('php://output');
    exit; 
 

// The following offers file to user on client side: deletes temp version of file
	header('Content-Description: File Transfer');
	header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($filename));
	flush();
	readfile($filename);
	unlink($filename); // deletes the temporary file */
		
	}
	catch(\Exception $e){
        $errorMessage="Unable to generate document, Because invalid arguments or invalid image names";
		return Redirect::back()->withErrors(['message', "$errorMessage"]);
		//return redirect()->back()->with('message',"$errorMessage");	
		
	}	
	        
}
	
function image_with_content($phpWord,$value)
{
	//image  with content template
	
    	$section = $phpWord->addSection(
    array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 300,
        'marginBottom' => 200,
        'headerHeight' => 300,
        'footerHeight' => 50,
    )
);
	$header = array('name' => 'Times New Roman','size' => 22.5, 'bold' => true);
	
	$section->addText(htmlspecialchars($value->title),$header);
   

	$text=$value->content;
    
	$textlines = explode("\n", $text);
	
	// to add image
	$imgtable=$section->addTable();
	$imgtable->addRow();
	
	
	$cell1=$imgtable->addCell(3400);
	foreach($value->contentImages as $contentImage)
	{
	$img1=url('/').'/'.trim($contentImage->image);
	$img1=str_replace(" ","%20","$img1");
	if(@is_array(getimagesize($img1))){
    $cell1->addImage($img1,array('width' => 218, 'height' => 200));
    }	
	$cell1->addTextbreak(2);	
	}	
	
    $description=$imgtable->addCell(7400);
	
    for ($i = 0; $i < sizeof($textlines); $i++) {
    $description->addText(htmlspecialchars($textlines[$i]),array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray'));
     }
    $footertable=$section->addFooter()->addTable();
    $footertable->addRow();
	$logo=url('/').'/'.$value->upload_path.trim($value->logo);
	$logo=str_replace(" ","%20","$logo");
	if(@is_array(getimagesize($logo))){
    $footertable->addCell(2250)->addImage($logo,array('width' => 150, 'height' => 50)); 
	}
	
	
    		

}

function map($phpWord,$map)
{ 
	
$mapstr="$map";	
 $map=str_replace(" ","%20","$mapstr");	

$fullpagesection = $phpWord->addSection(
      array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 0,
        'marginRight'  => 0,
        'marginTop'    => 0,
        'marginBottom' => 0,
        'headerHeight' => 0,
        'footerHeight' => 0,
    )
    );
	if(@is_array(getimagesize($map))){
	$fullpagesection->addImage($map,array('width' =>720, 'height' =>720));	
	}
}
	


	
	
function itinary_image_with_content($phpWord,$value)
{
	//image  with content template
	
    $section = $phpWord->addSection(
    array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 300,
        'marginBottom' => 200,
        'headerHeight' => 300,
        'footerHeight' => 50,
    )
);
	$header = array('name' => 'Times New Roman','size' => 22.5, 'bold' => true);
	$section->addText(htmlspecialchars($value->itinerary_date_with_title),array('name' => 'Times New Roman','size' => 11.5,'bold'=> true));
	$section->addText(htmlspecialchars($value->title),$header);
   

	$text=$value->content;
  
	$textlines = explode("\n", $text);
	
	// to add image
	$imgtable=$section->addTable();
	$imgtable->addRow();
	
	
	$cell1=$imgtable->addCell(3400);
	foreach($value->contentImages as $contentImage)
	{
	$img1=url('/').'/'.trim($contentImage->image);
	$img1=str_replace(" ","%20","$img1");
		
	if(@is_array(getimagesize($img1))){
    $cell1->addImage($img1,array('width' => 218, 'height' => 200));
    }	
	$cell1->addTextbreak(2);	
	}	
	
    $description=$imgtable->addCell(7400);
	
    for ($i = 0; $i < sizeof($textlines); $i++) {
    $description->addText(htmlspecialchars($textlines[$i]),array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray'));
     }
    $footertable=$section->addFooter()->addTable();
    $footertable->addRow();
	$logo=url('/').'/'.$value->upload_path.trim($value->logo);
	$logo=str_replace(" ","%20","$logo");
	if(@is_array(getimagesize($logo))){
     $footertable->addCell(2250)->addImage($logo,array('width' => 150, 'height' => 50));
    }
   
}
	
	
	
	
function logopage($phpWord,$value)
{
$logopagesection = $phpWord->addSection(
    array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 300,
        'marginBottom' => 200,
        'headerHeight' => 300,
        'footerHeight' => 50,
    )
);
$logo=url('/').'/'.$value->upload_path.trim($value->logo);
$logo=str_replace(" ","%20","$logo");
if(@is_array(getimagesize($logo))){
$logopagesection->addFooter()->addImage($logo,array('width' => 150, 'height' => 50));
}
}
	
function itinerary($phpWord,$value)
{


	
	$header = array('name' => 'Times New Roman','size' => 37.5, 'bold' => true);
	$itinerarysection = $phpWord->addSection(
    array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 300,
        'marginBottom' => 200,
        'headerHeight' => 300,
        'footerHeight' => 50,
    )
);

	
  
	// to add image
	$itinerarytable=$itinerarysection->addTable();
	$itinerarytable->addRow();
	
	$itinerarysubcell=$itinerarytable->addCell(7200);
	$itinerarysubcell->addText(htmlspecialchars($value->title),$header);
	$itinerarysubtable=$itinerarysubcell->addTable();
	
	$img=$itinerarytable->addCell(3600);
	
	foreach($value->itineraryImages as $itineraryImage )
	{
	$img1=url('/').'/'.trim($itineraryImage->image);
	$img1=str_replace(" ","%20","$img1");
	if(@is_array(getimagesize($img1))){
	$img->addImage($img1,array('width' => 230, 'height' => 120));
	}
	}
		
	foreach($value->itineraryData as $itineraryValue)
	{
	$dates="$itineraryValue->event_date";
	$date=date_create_from_format("Y-m-d","$dates");
	$itinerarydate= date_format($date,"M d");
	$itinerarydes=$itineraryValue->description;	
		
	$itinerarysubtable->addRow();	
	$date=$itinerarysubtable->addCell(2000);
	$date->addText("$itinerarydate:",array('name' => 'Times New Roman' ,'size' => 12 ,'color' => 'gray'));
	$date->addTextBreak(1);
	
		
	$description=$itinerarysubtable->addCell(5250);
	$description->addText(htmlspecialchars($itinerarydes),array('name' => 'Times New Roman' ,'size' => 12 ,'color' => 'gray'));
	$description->addTextBreak(1);
	}	
	
		
    
		
    $footertable=$itinerarysection->addFooter()->addTable();
    $footertable->addRow();
    $logo=url('/').'/'.$value->upload_path.trim($value->logo);
	$logo=str_replace(" ","%20","$logo");
	if(@is_array(getimagesize($logo))){
    $footertable->addCell(2250)->addImage($logo,array('width' => 150, 'height' => 50)); 
	}
	
}
	
function detailed_itinary($phpWord,$value)
{
	

    $detailed_itinarysection = $phpWord->addSection( array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 300,
        'marginBottom' => 200,
        'headerHeight' => 300,
        'footerHeight' => 50,
    ));
	$header = array('name' => 'Times New Roman','size' => 22.5, 'bold' => true);
	
	

	

	// to add image
	$datailitinarytable=$detailed_itinarysection->addTable();
	$datailitinarytable->addRow();
	$descriptioncell=$datailitinarytable->addCell(7000);
	$descriptioncell->addText(htmlspecialchars($value->title),$header);
	$descriptionTable=$descriptioncell->addTable();
	$imagecell=$datailitinarytable->addCell(3800);
	foreach($value->detailitineraryImages as $detailitineraryImage)
	{
	$img1=url('/').'/'.trim($detailitineraryImage->image);
	$img1=str_replace(" ","%20","$img1");	
	if(@is_array(getimagesize($img1))){	
	$imagecell->addImage($img1,array('width' => 230, 'height' => 120));
	}	
	}
	foreach($value->detailitineraryDatas as $detail_itineraryData)
	{
	$dates="$detail_itineraryData->event_date";
	$date=date_create_from_format("Y-m-d","$dates");
	$detail_itinerarydate=date_format($date,"M d");
	
	$descriptionTable->addRow();
	$date=$descriptionTable->addCell(7000);
	$date->addText(htmlspecialchars($detail_itinerarydate),array('name' => 'Times New Roman' ,'size' => 12 ,'color' => 'gray','bold' => true));
	$descriptionTable->addRow();
	$text=$detail_itineraryData->description;	
    $textlines = explode("\n", $text);	
	
	$description=$descriptionTable->addCell(7000);
	for ($i = 0; $i < sizeof($textlines); $i++) {
    $description->addText(htmlspecialchars($textlines[$i]));
		
                }
	}
	//$description->addText($text,array('name' => 'Times New Roman' ,'size' => 12 ,'color' => 'gray'));	
		
		
    $footertable=$detailed_itinarysection->addFooter()->addTable();
    $footertable->addRow();
    $logo=url('/').'/'.$value->upload_path.trim($value->logo);
	$logo=str_replace(" ","%20","$logo");
	if(@is_array(getimagesize($logo))){
    $footertable->addCell(2250)->addImage($logo,array('width' => 150, 'height' => 50)); 
	}
}
	
	
	
	
		
function frontpage($phpWord,$value)
{   
	 $dates="$value->start_date";
	 $date=date_create_from_format("Y-m-d","$dates");
	 $startdate=date_format($date,"M d, Y");
	 $datesend="$value->end_date"; 
	 $date=date_create_from_format("Y-m-d","$datesend");
 	 $enddate=date_format($date,"M d, Y");
	
	 //url('/').'/'.$value->upload_path.trim($value->logo)
	$frontpagesection = $phpWord->addSection(
    array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 0,
        'marginRight'  => 0,
        'marginTop'    => 0,
        'marginBottom' => 0,
        'headerHeight' => 0,
        'footerHeight' => 50,
    )
    );
	
	foreach($value->frontImages as $frontimage)
	{
	$fimage= url('/').'/'.$frontimage->image;
	$fimage=str_replace(" ","%20","$fimage");	
	}
	
	if(@is_array(getimagesize($fimage))){	
    $frontpagesection->addImage($fimage,array('width' => 750, 'height' => 500));
	}	
	$footertable=$frontpagesection->addFooter()->addTable();	
	$footertable->addRow();
	$imgcell=$footertable->addCell(8000);
	$logo=url('/').'/'.$value->upload_path.trim($value->logo);
	$logo=str_replace(" ","%20","$logo");
    if(@is_array(getimagesize($logo))){
     $imgcell->addImage($logo,array('width' => 150, 'height' => 50));
    }
	$textcell=$footertable->addCell(3000);
	$textcell->addtext(htmlspecialchars($value->country),array('name' => 'Times New Roman' ,'size' => 22.5 ,'color' => 'gray','bold' => true));
	$textcell->addtext(htmlspecialchars($startdate.'-'.$enddate),array('name' => 'Times New Roman' ,'size' => 12 ,'color' => 'gray'));	
	





}
	
function travalagent($phpWord,$value)
{
  //Travel agent
 	
	   
		
   
   $travalagentsection = $phpWord->addSection(
    array(
	    'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 500,
        'marginBottom' => 200,
        'headerHeight' => 200,
        'footerHeight' => 200,
    )
    );	
	$travelagenttable=$travalagentsection->addTable();
	
	foreach($value->travel_agent as $travelagent)
	{	
	$travelagenttable->addRow();
	
	$profile=url($value->upload_path).'/'.trim($travelagent->profile_image);
	$profile=str_replace(" ","%20","$profile");	
	$logo=url($value->upload_path).'/'.trim($travelagent->logo);
	$logo=str_replace(" ","%20","$logo");		
		
	$agentcell1=$travelagenttable->addCell(2000);
	if(@is_array(getimagesize($profile))){	
	$agentcell1->addImage($profile,array('width' => 100, 'height' => 100));
	}
	$namecell1=$travelagenttable->addCell(5000);
	$namecell1->addText(htmlspecialchars("YOUR TRAVEL AGENT IN $travelagent->place"),array('name' => 'Times New Roman' ,'size' => 9 ,'color' => 'gray','bold' => true));	
	$namecell1->addText(htmlspecialchars($travelagent->name),array('name' => 'Times New Roman' ,'size' => 12 ,'color' => 'gray'));
	if(@is_array(getimagesize($logo))){	
	$namecell1->addImage($logo,array('width' => 115, 'height' => 28));
	}	
	
	}
   $travalagentsection->addFooter()->addText('');
	

}
	
function fullpage($phpWord,$value)
{
   foreach($value->fullImages as $fullimage){
	$img1=url('/').'/'.trim($fullimage->image);
	$img1=str_replace(" ","%20","$img1");   
     }
	
	$fullpagesection = $phpWord->addSection(
      array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 0,
        'marginRight'  => 0,
        'marginTop'    => 0,
        'marginBottom' => 0,
        'headerHeight' => 0,
        'footerHeight' => 0,
    )
    );
	if(@is_array(getimagesize($img1))){
	$fullpagesection->addImage($img1,array('width' =>720, 'height' =>720));	
	}
}

function  emptypage($phpWord,$value)
{   
	//empty page with title
    $img1='http://localhost/dev_wtj/public/uploads/1495778510/test/Signature_image.jpg';
	
	$emptypagesection = $phpWord->addSection(
    array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 0,
        'marginRight'  => 0,
        'marginTop'    => 0,
        'marginBottom' => 0,
        'headerHeight' => 0,
        'footerHeight' => 0,
    )
    );	
	
    	$tableStyle = array(
       'borderColor' => '006699',
       'borderSize'  => 0,
       'cellMargin'  => 0,
	    'bgColor'   => "$value->empty_page_color"	
        );
		$firstRowStyle = array("bgColor" => "$value->empty_page_color");
		$phpWord->addTableStyle('emptypageTable', $tableStyle, $firstRowStyle);
		$emptypagetable = $emptypagesection->addTable('emptypageTable');
    		
    //$emptypagetable=$emptypagesection->addTable( array('bgColor' => '66BBFF'));
	$emptypagetable->addRow(10810);
	$emptypagecell=$emptypagetable->addcell(10800);
	
	$footertable=$emptypagesection->addFooter()->addTable();
    $footertable->addRow();
   $logo=url('/').'/'.$value->upload_path.trim($value->signature);
	$logo=str_replace(" ","%20","$logo");
	if(@is_array(getimagesize($logo))){
    $footertable->addCell(2250)->addImage($logo,array('width' => 150, 'height' => 50)); 
	}	


}
	
function  emptypagetitle($phpWord,$value)
{   
	//empty page with title
    $img1='http://localhost/dev_wtj/public/uploads/1495778510/test/Signature_image.jpg';
	
	$emptypagesection = $phpWord->addSection(
    array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 0,
        'marginRight'  => 0,
        'marginTop'    => 0,
        'marginBottom' => 0,
        'headerHeight' => 0,
        'footerHeight' => 0,
    )
    );	
	
    	$tableStyle = array(
       'borderColor' => '006699',
       'borderSize'  => 0,
       'cellMargin' => 500,  
	    'bgColor'   => "$value->empty_page_color"	
        );
		$firstRowStyle = array("bgColor" => "$value->empty_page_color");
		$phpWord->addTableStyle('emptypageTable', $tableStyle, $firstRowStyle);
		$emptypagetable = $emptypagesection->addTable('emptypageTable');
    		
    //$emptypagetable=$emptypagesection->addTable( array('bgColor' => '66BBFF'));
	$emptypagetable->addRow(10810);
	$emptypagecell=$emptypagetable->addcell(10800,array('valign' => 'center'));
	$emptypagecell->addText(htmlspecialchars("$value->title"),array('name' =>'Times New Roman', 'size' => 48.5, 'bold' => true, 'align' =>'right'));	
	
	$footertable=$emptypagesection->addFooter()->addTable();
    $footertable->addRow();
    $logo=url('/').'/'.$value->upload_path.trim($value->signature);
	$logo=str_replace(" ","%20","$logo");
	if(@is_array(getimagesize($logo))){
    $footertable->addCell(2250)->addImage($logo,array('width' => 150, 'height' => 50)); 
	}
}	
	
function  contentonly($phpWord,$value)
{
	// sales and terms condtions
    $text=$value->content;
		
   $textlines = explode("\n", $text);		
	
    $contentonlysection=$phpWord->addSection(
     array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 0,
        'marginRight'  => 0,
        'marginTop'    => 0,
        'marginBottom' => 0,
        'headerHeight' => 0,
        'footerHeight' => 50,
    )
   );
	$contenttable=$contentonlysection->addTable();
	$contenttable->addRow();	
	$contenttable->addCell(3000,array('valign' => 'top'))->addText(htmlspecialchars($value->title),array('name' => 'Times New Roman' ,'size' => 22.5 ,'color' => 'gray','bold' => true));
	

	
	$description=$contenttable->addCell(7800);
	for ($i = 0; $i < sizeof($textlines); $i++) {
    $description->addText(htmlspecialchars($textlines[$i]),array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray'));
	
	}
	
	$footertable=$contentonlysection->addFooter()->addTable();
    $footertable->addRow();
    $logo=url('/').'/'.$value->upload_path.trim($value->logo);
	$logo=str_replace(" ","%20","$logo");
	if(@is_array(getimagesize($logo))){
    $footertable->addCell(2250)->addImage($logo,array('width' => 150, 'height' => 50)); 
	}
}

function toptitlecontent($phpWord,$value)
{
// Terms conditions
		
  $text=$value->content;
		
  $textlines = explode("\n", $text);		

    $toptitlecontentsection=$phpWord->addSection(
    array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 0,
        'marginRight'  => 0,
        'marginTop'    => 0,
        'marginBottom' => 0,
        'headerHeight' => 0,
        'footerHeight' => 50,
    )
   );
	
	$contenttable= $toptitlecontentsection->addTable();
	$contenttable->addRow();	
	$contenttable->addCell(2000);
	$contentcell=$contenttable->addCell(8800);
	$contentcell->addText(htmlspecialchars($value->title),array('name' => 'Times New Roman' ,'size' => 22.5 ,'color' => 'gray','align' =>'right','bold' => true));
	$contentcell->addTextbreak(2);
	for ($i = 0; $i < sizeof($textlines); $i++) {
    $contentcell->addText(htmlspecialchars($textlines[$i]),array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray'));
	
	}
	
    $footertable=$toptitlecontentsection->addFooter()->addTable();
    $footertable->addRow();
    $logo=url('/').'/'.$value->upload_path.trim($value->logo);
	$logo=str_replace(" ","%20","$logo");
	if(@is_array(getimagesize($logo))){
    $footertable->addCell(2250)->addImage($logo,array('width' => 150, 'height' => 50)); 
	}

}

function summerypage($phpWord,$value,$data)
{
	 
   $dates="$value->date_of_release";
   $date=date_create_from_format("Y-m-d","$dates"); 
   $releasedate=date_format($date,"M d, Y");
	
		
	$signature=url('/').'/'.$value->upload_path.$value->signature;	
	
    $signature=str_replace(" ","%20","$signature");
    
    $summerypagesection=$phpWord->addSection(
     array(
		'pageSizeH'   => 10800,
		'pageSizeW'	   => 10800,
        'marginLeft'   => 300,
        'marginRight'  => 300,
        'marginTop'    => 1500,
        'marginBottom' => 300,
        'headerHeight' => 300,
        'footerHeight' => 50,
    )
   );
	
	
	
	$summerytable=$summerypagesection->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
	$summerytable->addRow();
	
	$textcell=$summerytable->addCell(3000,array('valign' => 'center'));
	$textcell->addText('Distinguished guests:',array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray'));
	
	$textcell1=$summerytable->addCell(3000);
	$textcell1->addText(htmlspecialchars($value->distinguished_guests),array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray'));
	
	$summerytable->addRow();
	
	$textcell2=$summerytable->addCell(3000,array('valign' => 'center'));
	$textcell2->addText('Agency:',array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray'));
	
	$textcell3=$summerytable->addCell(3000);
	$textcell3->addText(htmlspecialchars($value->agency),array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray'));
	
	$summerytable->addRow();
	
	$textcell4=$summerytable->addCell(3000,array('valign' => 'center'));
	$textcell4->addText('Agent:',array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray'));
	
	$textcell5=$summerytable->addCell(3000);
	$textcell5->addText(htmlspecialchars($value->agent),array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray'));
	
	$summerytable->addRow(500);
	$cell1=$summerytable->addCell(5400,array('gridSpan' => 2 ,'valign' => 'center'));
	
	
	
	
	$summerytable->addRow();
	
	$textcell10=$summerytable->addCell(3000,array('valign' => 'center'));
	$textcell10->addText('Duration:',array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray','bold' => true));
	
	$textcell11=$summerytable->addCell(3000);
	$textcell11->addText($value->duration_day. 'day / '.$value->duration_night . 'nights',array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray','bold' => true ));
		
	
	$summerytable->addRow();
	
	$textcell12=$summerytable->addCell(3000,array('valign' => 'center'));
	$textcell12->addText('Number of Persons:',array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray','bold' => true));
	
	$textcell13=$summerytable->addCell(3000);
	$textcell13->addText($value->no_of_persons,array('name' => 'Times New Roman' ,'size' => 10.5 ,'color' => 'gray','bold' => true ));
	
	
	$summerytable->addRow(1000);
	$empty1=$summerytable->addCell(3000,array('gridSpan' => 2 ,'valign' => 'center'));
	
	
	
	
	$summerytable->addRow();
	$cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
	$headcell=$summerytable->addCell(3000,$cellColSpan);	
    $headcell->addText('Summary',array('name' => 'Times New Roman' ,'size' => 22.5 ,'color' => 'gray'));
	
		
	foreach($data as $pages)
	{
	if ($pages->show_summery == 1)
	{
	$page=$pages->content_order+2;	
	$summerytable->addRow();
		
	$summerytable->addCell(3000)->addText(htmlspecialchars("$pages->title"),array('name' => 'Times New Roman' ,'size' => 11 ,'color' => 'gray'));
	$summerytable->addCell(3000)->addText("Page  $page",array('name' => 'Times New Roman' ,'size' => 11 ,'color' => 'gray'));	
	}
	}	
		
		
    $footertable=$summerypagesection->addFooter()->addTable();
    $footertable->addRow();
	$textcell=$footertable->addCell(8250);
	$textcell->addtext("Date of release:$releasedate",array('name' => 'Times New Roman' ,'size' => 11 ,'color' => 'gray'));	
	$imgcell=$footertable->addCell(2500);
	if(@is_array(getimagesize($signature))){
	$imgcell->addImage($signature,array('width' => 150, 'height' => 50)); 
	}
	 


}
	
	



}	
		
		
	

   


