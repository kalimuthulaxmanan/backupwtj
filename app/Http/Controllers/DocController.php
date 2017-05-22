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
		
$data = DB::table('files_directory')
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
	
			
		
		//return view('pdf.pdfview',['data'=>$appendData]);
              $filename=$value->file_name;
			header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: inline;Filename= $filename.doc");

echo $html; 
		//dd($data);
		

	}
	
	
	private function loadTemplate($template,$data,$data1=null)
	{
		
		$returndata=view('layouts.word.'.$template,['data'=>$data,'data1'=>$data1])->render();
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

		
		
 
							
	
		
		
/*	//image  with content template
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection(
	array(
		'paperSizeW'    => 7500,
		'paperSizeH'    => 7500,
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 200,
        'marginBottom' => 200,
        'headerHeight' => 50,
        'footerHeight' => 50,
    ));
	$header = array('size' => 48, 'bold' => true);
	
	$section->addText('Welcome to France',$header);
	$img1='http://localhost/dev_wtj/public/uploads/1494940055/test/front_page_image.jpg';
	$img2='http://localhost/dev_wtj/public/uploads/1494940055/test/im3.jpg';
    $img3='http://localhost/dev_wtj/public/uploads/1494940055/test/logo_image.png';
	$text='Mars is the fourth planet from the Sun and the second-smallest planet in the Solar System, after Mercury. Named after the Roman god of war, it is often referred to as the "Red Planet"[13][14] because the iron oxide prevalent on its surface gives it a reddish appearance.Mars is a terrestrial planet with a thin atmosphere, having surface features reminiscent both of the impact craters of the Moon and the valleys, deserts, and polar ice caps of Earth.';
  
	// to add image
	$imgtable=$section->addTable();	
	$imgtable->addRow();
	
	$cell1=$imgtable->addCell();
	$cell1->addImage($img1,array('width' => 210, 'height' => 210));
	$cell1->addImage($img2,array('width' => 210, 'height' => 210));	
    $imgtable->addCell(array('valign' => 'top','textDirection'=> \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR))->addText($text);
	
    $footertable=$section->addTable();
    $footertable->addRow();
    $footertable->addCell()->addImage($img3,array('width' => 150, 'height' => 50)); 
    $section->addPagebreak();
	
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
	$objWriter->save('helloWorld.doc');die;	  
	
/*	//itinary  template	
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();
	$header = array('size' => 48, 'bold' => true);
	
	$section->addText('Itinerary title',$header);
	$img1='http://localhost/dev_wtj/public/uploads/1494940055/test/im3.jpg';
	$img2='http://localhost/dev_wtj/public/uploads/1494940055/test/im1.jpg';
    $img3='http://localhost/dev_wtj/public/uploads/1494940055/test/im2.jpg';
	$img4='http://localhost/dev_wtj/public/uploads/1494940055/test/im4.jpg';
	$img5='http://localhost/dev_wtj/public/uploads/1494940055/test/logo_image.png';	
	
  
	// to add image
	$itinerarytable=$section->addTable(5000);	
	$itinerarytable->addRow();
	$date=$itinerarytable->addCell(200);	
	$date->addText('Apr 28:');
	$date->addText('Apr 29:');
	$date->addText('Apr 30:');
		
	$description=$itinerarytable->addCell(1000);
	$description->addText('Arrival in Tokyo');
	$description->addText('Hakone');
	$description->addText('Departureh.');
		
	$img=$itinerarytable->addCell(3800);
	$img->addImage($img1,array('width' => 210, 'height' => 210));
	$img->addImage($img2,array('width' => 210, 'height' => 210));
	$img->addImage($img3,array('width' => 210, 'height' => 210));	
	$img->addImage($img4,array('width' => 210, 'height' => 210));
		
    
		
    $footertable=$section->addTable();
    $footertable->addRow();
    $footertable->addCell()->addImage($img5,array('width' => 150, 'height' => 50));
 
	
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
	$objWriter->save('helloWorld.doc');die;   */
		
/*
	// detailed itinary 	
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();
	$header = array('size' => 48, 'bold' => true);
	
	$section->addText('Itinerary title',$header);
	$img1='http://localhost/dev_wtj/public/uploads/1494940055/test/im3.jpg';
	$img2='http://localhost/dev_wtj/public/uploads/1494940055/test/im1.jpg';
    $img3='http://localhost/dev_wtj/public/uploads/1494940055/test/im2.jpg';
	$img4='http://localhost/dev_wtj/public/uploads/1494940055/test/im4.jpg';
	$img5='http://localhost/dev_wtj/public/uploads/1494940055/test/logo_image.png';	
	$text='Arrive at Narita/Haneda Airport independently

After entry procedures, meeting English speaking greeting service, and Japanese speaking driver

Drive to Tokyo

Transfer to the hotel (accommodation arranged directly by Tauck, not included in tour fare)

Transfers will be arranged and invoiced as supplements (not included in base tour fare) according to flight schedule.

Guests arriving on different flights cannot share greeting service or driver in case of delays

Evening Cocktail Reception and Dinner (arranged directly by Tauck, not included in tour fare)';
  
	// to add image
	$datailitinarytable=$section->addTable();
	$datailitinarytable->addRow();
	$descriptioncell=$datailitinarytable->addCell();
	$descriptioncell->addText('Detailed itinerary title',$header);
	$descriptionTable=$descriptioncell->addTable();
	$imagecell=$datailitinarytable->addCell();
	$imagecell->addImage($img1,array('width' => 210, 'height' => 210));
	$imagecell->addImage($img2,array('width' => 210, 'height' => 210));
	$imagecell->addImage($img3,array('width' => 210, 'height' => 210));
	$imagecell->addImage($img4,array('width' => 210, 'height' => 210));	
	
	$descriptionTable->addRow();
	$date=$descriptionTable->addCell();
	$date->addText('Jan 01');
	$descriptionTable->addRow();	
	$description=$descriptionTable->addCell();
	$description->addText($text);	
		
		
    $footertable=$section->addTable();
    $footertable->addRow();
    $footertable->addCell()->addImage($img5,array('width' => 150, 'height' => 50));
 
	
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
	$objWriter->save('helloWorld.doc');die;  	*/
		
  // frontpage
/*	$phpWord = new \PhpOffice\PhpWord\PhpWord();
   
	
	$section = $phpWord->addSection(
    array(
        'marginLeft'   => 0,
        'marginRight'  => 0,
        'marginTop'    => 0,
        'marginBottom' => 0,
        'headerHeight' => 0,
        'footerHeight' => 0,
    )
    );	
	$img1='http://localhost/dev_wtj/public/uploads/1494940055/test/front_page_image.jpg';
	$img2='http://localhost/dev_wtj/public/uploads/1494940055/test/logo_image.png';	
    $section->addImage($img1,array('width' => 680, 'height' => 500));
	$footertable=$section->addTable();	
	$footertable->addRow();
	$imgcell=$footertable->addCell(3800);
	$imgcell->addImage($img2,array('width' => 150, 'height' => 50));
	$textcell=$footertable->addCell();
	$textcell->addtext('France');
	$textcell->addtext('April 08 2017');	
		
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
	$objWriter->save('helloWorld.doc');die;  */	
		
  /*  //Travel agent
   $img1='http://localhost/dev_wtj/public/uploads/1494940055/test/agg1.jpg';
   $img2='http://localhost/dev_wtj/public/uploads/1494940055/test/agg2.jpg';
   $img3='http://localhost/dev_wtj/public/uploads/1494940055/test/ag1.jpg';
   $img4='http://localhost/dev_wtj/public/uploads/1494940055/test/ag2.jpg';		
	   
		
   $phpWord= new \PhpOffice\PhpWord\PhpWord();
   $section = $phpWord->addSection(
    array(
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 500,
        'marginBottom' => 200,
        'headerHeight' => 200,
        'footerHeight' => 200,
    )
    );	
	$travelagenttable=$section->addTable();
	$travelagenttable->addRow();
	$profilecell=$travelagenttable->addCell();	
	$profilecell->addImage($img1,array('width' => 100, 'height' => 100));
	$profilecell->addImage($img2,array('width' => 100, 'height' => 100));
	$namecell=$travelagenttable->addCell();
	$namecell->addText('YOUR TRAVEL AGENT IN NETHERLANDS');	
	$namecell->addText('Obama');		
	$namecell->addImage($img3,array('width' => 115, 'height' => 28));
	$namecell->addText('YOUR TRAVEL AGENT IN IRRAEL');	
	$namecell->addText('Tramp');	
	$namecell->addImage($img4,array('width' => 115, 'height' => 28));	
	
		
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
	$objWriter->save('helloWorld.doc');die;	*/
	
		
		
		//full image page	
  /* 	$img1='http://localhost/dev_wtj/public/uploads/1494940055/test/mars.jpg';
	$phpWord= new \PhpOffice\PhpWord\PhpWord();
	$section = $phpWord->addSection(
    array(
		'paperSize'    => 'A4',
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 200,
        'marginBottom' => 200,
        'headerHeight' => 50,
        'footerHeight' => 50,
    )
    );
	$section->addImage($img1,array('width' =>680, 'height' =>900));	
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
	$objWriter->save('helloWorld.doc');die;	*/
    /*    //empty page with title
    $img1='http://localhost/dev_wtj/public/uploads/1494940055/test/Signature_image.jpg';
	$phpWord= new \PhpOffice\PhpWord\PhpWord();	
	$section = $phpWord->addSection(
    array(
		'paperSize'    => 'A4',
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 200,
        'marginBottom' => 200,
        'headerHeight' => 50,
        'footerHeight' => 100,
    )
    );	
    $imgstyle= array('positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE);		

	$section->addText('ARMONGDON IS COMING',array('size' => 28, 'bold' => true, 'align' =>'right'));	
	$section->addImage($img1,array('width' => 150, 'height' => 50 )); 	
	
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
	$objWriter->save('helloWorld.doc');die;	*/
    
		
		
		
/*		// sales and terms condtions
    $text='Please note that our quotes are merely informative as all services are subject to availability. All fares and availabilities will therefore be confirmed on the day you confirm your client’s booking by faxing us back the signed credit card authorization form.

TOTAL COST INCLUDES THE FOLLOWING:

The total NET price provided by Découvertes includes the services listed, a tailor-made itinerary, Découvertes’ fees and taxes. We consider that our negotiated rates are confidential and therefore, as a general rule, Découvertes does not provide a break-down of rates and services – thank you for your understanding.

VIP TREATMENT

- Personalised Itinerary
- Prepaid Voucher/s
- Co-ordination and Support
- 24 hours Concierge service (Assistance) during your trip

TRIP COST DOES NOT INCLUDE:

- Airfare not listed in the itinerary
- Transfers not specified in the itinerary
- Entrances fees when not mentioned
- Meals when not mentioned
- Room Service
- Excess Baggage Charges
- Porterage
- Passport and Visa Fees
- Personal & Travel Insurance
- Gratuities
- Any Item specified as ‘Own Arrangements’';
		
		
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section=$phpWord->addSection(
    array(
		'paperSize'    => 'A4',
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 200,
        'marginBottom' => 200,
        'headerHeight' => 50,
        'footerHeight' => 100,
    ) 
   );
	$contenttable=$section->addTable(array(
      'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50,
    ));
	$contenttable->addRow(5000);	
	$contenttable->addCell(2000,array('valign' => 'top'))->addText('Sales and terms conditions');
	$contenttable->addCell(3000)->addText(nl2br($text));	

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
$objWriter->save('helloWorld.doc'); */
		
		
	/*	
	// Terms conditions
		
		$text='RESERVATIONS

GUIDE- DRIVERS Vs DRIVER-GUIDES:

Our Guide-drivers will chauffeur your clients; they are also licensed to guide and accompany them into museums and monuments.

Driver-guides are NOT qualified to enter and guide your clients into museums, as well as around historical monuments and sights, for this purpose we recommend your clients have either a driver AND a guide or a Guide who is licensed and insured to drive. Our Driver-guides all speak very good English and will chauffeur your clients on sightseeing tours, their knowledge of the historical aspects of the territory can NOT be incompared to that of a guide.

A 30% deposit is requested at the time of booking and full payment 45 days prior to your clients arrival in France, unless otherwise advised. Payment is made in Euros and can be made by credit card, US Dollars check, Euro check or wire transfer.

Découvertes accepts the following credit cards: American Express, Visa and Mastercard. Please note that Découvertes does not charge any supplement for credit card payments.

FINAL DOCUMENTS

You will receive, via email, 30 days prior to the travelers arrival in France the following documentation: General Prepaid Voucher, Individual Vouchers for hotels and special services where required.';
		
		
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section=$phpWord->addSection(
    array(
		'paperSize'    => 'A4',
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 200,
        'marginBottom' => 200,
        'headerHeight' => 50,
        'footerHeight' => 100,
    ) 
   );
	$contenttable=$section->addTable(array(
      'unit' => 'pct',
      'width' => 100 * 50,
    ));
	$contenttable->addRow(5000);	
	$contenttable->addCell(2000);
	$contentcell=$contenttable->addCell(3000);
	$contentcell->addText('Terms conditions',array('size' => 28, 'bold' => true, 'align' =>'right'));
	$contentcell->addText(nl2br($text));	
    
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
    $objWriter->save('helloWorld.doc');	*/
		
	//summer page	
	 	
/*	$img1='http://localhost/dev_wtj/public/uploads/1494940055/test/Signature_image.jpg';	
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section=$phpWord->addSection(
    array(
		'paperSize'    => 'A4',
        'marginLeft'   => 200,
        'marginRight'  => 200,
        'marginTop'    => 200,
        'marginBottom' => 200,
        'headerHeight' => 50,
        'footerHeight' => 100,
    ) 
   );
	$summerytable=$section->addTable(array('width' => 100 * 50, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
	$summerytable->addRow();
	$textcell=$summerytable->addCell(2500,array('gridSpan' => 2 ,'valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR));
	$textcell->addText('Distinguished guests:Antonio Compton');
	$textcell->addText('Agency:American Express - Boston (HQ)');
	$textcell->addText('Agent: Cassandra Angus');
	$textcell->addTextBreak(2);	
	$textcell->addText('Duration: 1 day / 0 nights');
	$textcell->addText('Number of Persons:2');
	$summerytable->addRow();
	$headcell=$summerytable->addCell(2500,array('gridSpan' => 2 ,'valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR));	
    $headcell->addText('Summary');
	$summerytable->addRow();	
	$summerytable->addCell()->addText('Welcome in France');
	$summerytable->addCell()->addText('page 04');	
   	$summerytable->addRow();	
	$summerytable->addCell()->addText('Your itinerary');
	$summerytable->addCell()->addText('page 06');	
	$summerytable->addRow();	
	$summerytable->addCell()->addText('Champagne');
	$summerytable->addCell()->addText('page 10');	
	$summerytable->addRow();	
	$summerytable->addCell()->addText('Paris');
	$summerytable->addCell()->addText('page 12');	
   	$summerytable->addRow();	
	$summerytable->addCell()->addText('Detailed itinerary');
	$summerytable->addCell()->addText('page 18');	
	$summerytable->addRow();	
	$summerytable->addCell()->addText('Sales and terms conditions	');
	$summerytable->addCell()->addText('page 19');		
		
    $footertable=$section->addTable();
    $footertable->addRow();
	$textcell=$footertable->addCell();
	$textcell->addtext('Date of release:Mar 29, 2017');	
	$imgcell=$footertable->addCell(3800);
	$imgcell->addImage($img1,array('width' => 150, 'height' => 50)); 
	
	 
		
		
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
$objWriter->save('helloWorld.doc');   		*/
		


//$source='/var/www/html/dev_wtj/public/titleleftimagecontentpage.html';
//$source='/var/www/html/dev_wtj/public/itinerarytitle.html';
//$source='/var/www/html/dev_wtj/public/detaileditinerary.html';
//$source='/var/www/html/dev_wtj/public/forntpage.html';		
//$source='/var/www/html/dev_wtj/public/tablecheck.html';		
//$phpWord = \PhpOffice\PhpWord\IOFactory::load($source, 'HTML');
//echo "<pre>";
//print_r($phpWord);die();		
//$phpWord->save('helloWorld.doc');
//echo "document created"; 	
		
		
	

   


