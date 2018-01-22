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
use App\Http\Controllers\ValidateController;
use DateTime;

class ValidateExcelDataController extends BaseController
{
	public $Filevalue;
	public $countorder=1;
	public $error=[];
	public function backgroundWork()
	{
		Artisan::call('import:excel');
	}
	
	private function validatedata($rows,$fileId)
	{
	  $templateId=$this->template_validate($rows);//die;
      if($templateId)
	  {	  
		  
		  switch($rows[1])
		  {      
			     case 'front_page':
					  $this->insertFrontPage($rows,$templateId,$fileId);

				  break;
				  
				  case 'empty_page':
				  case 'full_image_page';
				  case 'empty_page_with_title';
				  case 'content_only';
				  case 'image_with_content';
					  $this->insert_content($rows,$templateId,$fileId);
				  break;
				  
				  case 'itinerary':
				  	  $this->insert_itinerary($rows,$templateId,$fileId);
				  break;
				  
				  case 'detail_itinerary':
					  $this->insert_detail_itinerary($rows,$templateId,$fileId);
				  break;				  
				  
				  case 'map':
					  $this->insert_map($rows,$templateId,$fileId);
				  break;
				  
				  case 'travel_agent':
					  $this->insert_travel_agent($rows,$templateId,$fileId);
				  break;
 				  
		  }	  
  
	  }
		
	}
	
	
	private function insert_travel_agent($row,$templateId,$fileId)
	{	
		$contentId=$this->insert_content($row,$templateId,$fileId);
		
		if($row[30]!="")
		{
			$name=explode("|||",$row[30]);
			$profileImage=explode("|||",$row[31]);
			$place=explode("|||",$row[32]);
			$logo=explode("|||",$row[33]);
			if(count($name) > 3 || count($profileImage) > 3 || count($place) > 3)
			{
			 $msg='only 4 agents allow, please make it correct in  s.no '.$row[0];
			 $this->error[]=$msg; 
			}	
			
			foreach($name as $key=>$value)
			{
			 if(isset($value) && isset($profileImage[$key]) && isset($place[$key]))	
			 {
			   if(strlen($value) > 55){
			    $msg='"NAME" field exceeds the 55 characters limit, please make it correct in  s.no '.$row[0];
			    $this->error[]=$msg; 
			   }
			   if(strlen($place[$key]) > 25){
			   $msg='"PLACE" field exceeds the 25 characters limit, please make it correct in  s.no '.$row[0];
			   $this->error[]=$msg;
			   }
				   
				 
			 }
				
			}

		}
		 
		
	}
	
	private function insert_content($row,$templateId,$fileId,$count='NULL')
	{
		
			$array=[
			'title',
			'show_summery',
			'full_page_image',
			'image_alignment',
			'content',
			'empty_page_color',
			'itinerary_date_with_title',
			'content_order'			
		];
		
	   $fillableRow=['15','16','17','19','20','21','22','0'];
		
		$data=$this->generateData($array,$fillableRow,$row);
		
		foreach($data as $key => $value){
		if($key=='title'){
		  if(strlen($value) > 55){
			 $msg='"HEADING / TITLE" field exceeds the 55 characters limit, please make it correct in  s.no '.$data['content_order'];
			 $this->error[]=$msg;  
		  }
		}
		elseif($key=='itinerary_date_with_title')
		{
		   if(strlen($value) > 100){
			 $msg='"Itinerary Date with Title" field exceeds the 100 characters limit, please make it correct in  s.no '.$data['content_order'];
			 $this->error[]=$msg;  
		  }
		
		}
		elseif($row[1]=='image_with_content')
		{	
		 if($key=='content'){
		 $this->insert_image_with_content($row);	 
		 $str=$data[$key];	 
		 $str=wordwrap($str,71, "\n");
		 $lines_arr = preg_split('/\n|\r/',$str);
		 $num_newlines = count($lines_arr); 
			 if($num_newlines > 31){
             $msg='"CONTENT" field exceeds the page size,  please limit the content  in  s.no '.$data['content_order'];
			 $this->error[]=$msg; 	
			 } 	 
		 
		 }
		}	
		}	
		
	}
		
	
	private function insert_map($row,$templateId,$fileId)
	{
		$contentId=$this->insert_content($row,$templateId,$fileId);
		//dd($fillableRow);
		$array=[
			'address',
			'lat',
			'lon'
		];
		
		
		if($row[27]!="")
		{
			$address=explode("|||",$row[27]);
			$lat=explode("|||",$row[28]);
			$lon=explode("|||",$row[29]);
			if(count($lat)!=count($lon)){
			 $msg='please make sure the map "longitude" and "latitude" details';
			 $this->error[]=$msg; 
			}

		
	   }
	}
	private function insert_detail_itinerary($row,$templateId,$fileId)
	{    
		if($row[18]!="" && $row[25]!="" && $row[26]!="")
		{
		 if(strlen($row[15]) > 21){
		 $msg= '"detail_itinerary title" field exist 20 characters,  please verify in s.no '.$row[0];
		 $this->error[]=$msg;
		 }	
		$imageData=explode("|||",$row[18]);
		$imgcount=count($imageData);
		if($imgcount > 5)
		{   
			$datacount=$imgcount/5;
			$roundcount=round($datacount);
			if( $roundcount  < $datacount )
			{		
			  $datacount=$roundcount+1;
			}
			else{
			$datacount=$roundcount;
			}
		}
		else{
		  $datacount=1;	
		}   
			$j=0;$k=0;
			for($i=1;$i<=$datacount;$i++)
			{
				$contentData=explode("|||",$row[26]);
				$dateData=explode("|||",$row[25]);
				$countdateData=count($dateData);
				$countcontentData=count($contentData);
				
				if($countdateData!=$countcontentData){
				$msg= '"EVENT DATE" field doesnot match with "DESCRIPTION" field,  please verify in s.no '.$row[0];
				$this->error[]=$msg;
				}
				$roundcontentData=round($countcontentData/$datacount);
				$contentData=array_slice($contentData,$j,$roundcontentData);
				
				$str='';
				foreach($contentData as $contentDatas)
				{
				$str.="\n".$contentDatas."\n";
				}
            
				$str=wordwrap($str,71, "\n");
				$lines_arr = preg_split('/\n|\r/',$str);
				$num_newlines = count($lines_arr); 
				
				$allowedlines=28;

				if($num_newlines > $allowedlines )
				{
					$msg= '"detail itinerary events" exceeds the page size, please limit the event in  s.no '.$row[0];
					$this->error[]=$msg;	
				}
		       $j=$i*$roundcontentData;	
			}		
		}
		else{
		 $msg= 'detail itinerary page template missed the image or event or date please verify in s.no '.$row[0];
		 $this->error[]=$msg;
		
		}
	 			
		
	}
	
	private function insert_itinerary($row,$templateId,$fileId)
	{   
		if($row[18]!="" && $row[23]!="" &&  $row[24]!="")
		{
		 if(strlen($row[15]) > 21){
		 $msg= '"itinerary title" field exceeds 20 characters,  please verify in s.no '.$row[0];
		 $this->error[]=$msg;
		 }
		$imageData=explode("|||",$row[18]);
		$imgcount=count($imageData);
		if($imgcount > 5)
		{   
			$datacount=$imgcount/5;
			$roundcount=round($datacount);
			if( $roundcount  < $datacount )
			{		
			  $datacount=$roundcount+1;
			}
			else{
			$datacount=$roundcount;
			}
		}
		else{
		  $datacount=1;	
		}  
			$j=0;$k=0;
			for($i=1;$i<=$datacount;$i++)
			{	
				$contentData=explode("|||",$row[24]);
				$dateData=explode("|||",$row[23]);
				$countdateData=count($dateData);
				$countcontentData=count($contentData);
			
				if($countdateData!=$countcontentData){
				$msg= '"EVENT DATE" field doesnot match with "DESCRIPTION" field,  please verify in s.no '.$row[0];
				$this->error[]=$msg;
				}
				$roundcontentData=round($countcontentData/$datacount);
				$contentData=array_slice($contentData,$j,$roundcontentData);	
				 $str='';
				foreach($contentData as $contentDatas)
				{
				$str.=$contentDatas."\n";
				}	

				$str=wordwrap($str,47, "\n");
				$lines_arr = preg_split('/\n|\r/',$str);
				$num_newlines = count($lines_arr);  
				$allowedlines=20;

				if($num_newlines > $allowedlines )
				{
					$msg= '"itinerary events"  exceeds the page size, please limit the event in  s.no '.$row[0];
					$this->error[]=$msg;

				}
			 $j=$i*$roundcontentData;	
			}	
		}
		else{
		 
		 $msg= 'itinerary page template missed the image or event or date, please verify in s.no'.$row[0];
		 $this->error[]=$msg;
		
		}
		     
		
	}
	
	private function insert_image_with_content($row)
	{
				
		
		
		if($row[18]!="")
		{
			if($row[1]=='image_with_content')
			{
			$imageData=explode("|||",$row[18]);
		    $imageDatacount=count($imageData);
			if($imageDatacount > 2){
			$msg= "image_with_content template contains $imageDatacount images.it only allow only 2 images.please make  change in s.no ".$row[0];
			$this->error[]=$msg;	
			} 	
			}	
			$imageData=explode("|||",$row[18]);
		
		}
		
		
		
	}
	

	
	
	private function insertFrontPage($row,$templateId,$fileId)
	{
		
		//$this->insert_content($row,$templateId,$fileId);
		$fillableRow=['2','3','4','5','6','7','9','10','11','12','14','8','18','13'];
		$array=[
			'distinguished_guests',
			'agency',
			'agent',
			'duration_day',
			'duration_night',
			'no_of_persons',
			'start_date',
			'end_date',
			'country',
			'place',
			'signature', 
			'logo',
			'front_page_image', 
			'date_of_release'
		];
		
		$data=$this->generateData($array,$fillableRow,$row);
		$data['file_id']=$fileId->id;
		$data['user_id']=$fileId->user_id;
		$data['created_at']=date('Y-m-d H:i:s');
	    
	    foreach($data as $key => $value){
				
	   $value=preg_replace('/[\x00-\x1F\x7F-\xFF]/', '  ', $value);
		
		/*
		*validate front page 
		*/	 	
		if($key=='distinguished_guests' || $key== 'agency' || $key=='agent')
		{
			
			 if(strlen($value) > 50){
				 $msg='"'.$key.'" field exceeds the 50 characters limit, please make it correct in s.no '.$row[0];
				 $this->error[]=$msg;
				
		 }
		}
				
		 elseif($key=='duration_day' || $key== 'duration_night' || $key=="no_of_persons")
		 {   
			 $validInt = filter_var($value, FILTER_VALIDATE_INT);
			 if(!($validInt)){
			  $msg ='"'.$key.'" field must be an interger'; 
			  $this->error[]=$msg;
			 }
			 elseif($value > 9999){
			 $msg= '"'.$key.'" field must be lower than 1000'; 
			 $this->error[]=$msg;
			 }

		 }
			
		/* elseif($key=='start_date' || $key=='end_date' || $key=='date_of_release')
		 {
			 $date=$value;
			 $dt = DateTime::createFromFormat("m/d/Y", $date);
			 if(!($dt !== false && !array_sum($dt->getLastErrors())))
			 {
			  $msg=	$key.' must be m/d/Y format ex:09/12/2012';
			  $this->error[]=$msg;	 
			 }
		
		 } */
			
			
		 elseif ($key=='country' || $key == 'place')
		 {
			if(preg_match('/\\d/', $value) > 0 || strlen($value) > 8 )
			{
			  $msg=	'"'.$key.'" field must be string and less than 8 character'; 
			   $this->error[]=$msg;		
			}
		 
		 }		

			
		}	
	
	}
	
	
	private function generateData($array,$fillableRow,$row)
	{
		$data=[];
		foreach($fillableRow as $key=>$value)
		{
				$data[$array[$key]]=trim($row[$value]);
		
		}
		return $data;
	}
	
	private function template_validate($rows)
	{
	    $user = DB::table('pdf_templates')->where('name', $rows[1])->first();

		if(!empty($user))
		{
			return $user->id;
			
		}
		else
		{
			return false;
		}
		
	}

	 public function importExcel($value)//$path)
	{
		//dd($value);
		$this->Filevalue=$value;
		 $path=$value->upload_path.'/'.$value->file_name; //die;
         //$path='/home/kenhiket430/Downloads/date09-18-2017/276_t1/data1.xlsx';
 
		$data = \Excel::load($path,function($reader)								 
		{
			$reader->noHeading();
			$reader->skipRows(2);
			//dd($this->Filevalue);

			$reader->each(function($sheet,$value) {
				$this->validatedata($sheet,$this->Filevalue);
			});
		});
		
		return $this->error;

	}
}
	