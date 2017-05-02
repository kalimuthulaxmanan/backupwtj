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
class ImportExcelDataController extends BaseController
{
	public $Filevalue;
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
			foreach($name as $key=>$value)
			{
			 if(isset($value) && isset($profileImage[$key]) && isset($place[$key]))	
			 {
				$array=[
					'file_id'=>$fileId->id,
					'content_id'=>$contentId,
				'name'=>$value,
					'profile_image'=>$profileImage[$key],
					'place'=>$place[$key],
					'logo'=>$logo[$key],'created_at'=>date('Y-m-d H:i:s')
			];
				$inserted=$this->insert('pdf_travel_agent',$array);
			 }
			}

		}		
		
	}
	
	private function insert_content($row,$templateId,$fileId)
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
		$data['file_id']=$fileId->id;
		$data['user_id']=$fileId->user_id;
		$data['template_id']=$templateId;
		$data['created_at']=date('Y-m-d H:i:s');
		//dd($fileId);
		$content_id=$this->insert('pdf_content',$data);
		$this->insert_image_with_content($row,$content_id);
		
		return $content_id;
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
			foreach($address as $key=>$value)
			{
			 if(isset($value) && isset($lat[$key]) && isset($lon[$key]))	
			 {
				$array=[
					'file_id'=>$fileId->id,
					'content_id'=>$contentId,
				'address'=>$value,
					'lat'=>$lat[$key],
					'lon'=>$lon[$key],'created_at'=>date('Y-m-d H:i:s')
			];
				$inserted=$this->insert('pdf_map',$array);
			 }
			}

		}
		
		//$data=$this->generateData($array,$fillableRow,$row);
		
		//$this->insert('pdf_map',$data);
		
	}
	
	private function insert_detail_itinerary($row,$templateId,$fileId)
	{
		    $contentId=$this->insert_content($row,$templateId,$fileId);	
		
			if($row[25]!="")
			{
				$dateData=explode("|||",$row[23]);
				$contentData=explode("|||",$row[26]);
				foreach($dateData as $key=>$value)
				{
					$array=[
							'file_id'=>$fileId->id,
					'content_id'=>$contentId,
					'event_date'=>date('Y-m-d',strtotime($value)),
					'description'=>$contentData[$key],'created_at'=>date('Y-m-d H:i:s')
				];
					$inserted=$this->insert('pdf_itinenary_details',$array);
				}

			}
		
		
	}
	
	private function insert_itinerary($row,$templateId,$fileId)
	{
		//dd($row[23]);
		$contentId=$this->insert_content($row,$templateId,$fileId);

		
			if($row[23]!="")
			{
			//	echo $row[23];
				$dateData=explode("|||",$row[23]);
				//dd($dateData);
				$contentData=explode("|||",$row[24]);
				foreach($dateData as $key=>$value)
				{
					$array=[
					'file_id'=>$fileId->id,
					'content_id'=>$contentId,
					'event_date'=>date('Y-m-d',strtotime($value)),
					'description'=>$contentData[$key],'created_at'=>date('Y-m-d H:i:s')
				];
					
					//dd($array);
					$inserted=$this->insert('pdf_itinenary',$array);
					//dd($array);
				}

			}
		else
		{
			echo "hai";
			die;
		}
		

		
	}
	
	private function insert_image_with_content($row,$content)
	{
				
		
		
		if($row[18]!="")
		{
			$imageData=explode("|||",$row[18]);
			foreach($imageData as $key=>$value)
			{
				$imageData=["content_id"=>$content,"image"=>$value,'created_at'=>date('Y-m-d H:i:s')];
				$this->insert('pdf_content_images',$imageData);
			}

		}
		
		
		
	}
	

	
	
	private function insertFrontPage($row,$templateId,$fileId)
	{
		
		$this->insert_content($row,$templateId,$fileId);
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
		$this->insert('pdf_common_fields',$data);

	}
	
	private function insert($tableName,$data)
	{		
		$status=DB::table($tableName)->insertGetId($data);
		return $status;
		
	}	
	
	private function generateData($array,$fillableRow,$row)
	{
		$data=[];
		foreach($fillableRow as $key=>$value)
		{
			if($array[$key]=="start_date" || $array[$key]=="end_date")
			{
			  $data[$array[$key]]=date('Y-m-d',strtotime($row[$value]));
			}
			else
			{
				$data[$array[$key]]=$row[$value];
			}
								//'event_date'=>date('Y-m-d',strtotime($value)),

			
			
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
		 $path='uploads/'.$value->file_name; //die;

    //  $path='/home/kenhike/Downloads/Antonio Compton.xlsx';
//dd($path);
		$data = \Excel::load($path,function($reader)								 
		{
			$reader->noHeading();
			$reader->skipRows(2);
			//dd($this->Filevalue);

			$reader->each(function($sheet,$value) {
				$this->validatedata($sheet,$this->Filevalue);
			});
		});

	}
}
	