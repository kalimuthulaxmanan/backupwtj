<!-- Section Start -->
<style type="text/css">
	.detailitinerary-image img{
		width: 100%;
		height: 144px;
	}
	.detailitinerary-content{
		padding-left:20px;
		width: 330px;		
	}
</style>
<section class="">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-8 col-sm-8 col-xs-12">
				<h1 class="left-title">{{$data->title}}</h1> 
				@foreach($data->detailitineraryDatas as $detail_itineraryData)
				<p><b><?php $dates=$detail_itineraryData->event_date; $date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"F d");?></b></p>
				<p class="lh-20 detailitinerary-content">
					{!!nl2br($detail_itineraryData->description)!!}<br />										 
				</p> 
				@endforeach
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 padd-0">
				@foreach($data->detailitineraryImages as $detailitineraryImage)
				<div class="detailitinerary-image change-image" style="margin-right:0px;">
					<img src="{{ url('/') }}/<?php echo trim($detailitineraryImage->image); ?>" alt="" title="" id="image{{$detailitineraryImage->id}}" />
					<div class="img-overlay">
						<a  onclick="newFunction('image{{$detailitineraryImage->id}}',{{$detailitineraryImage->id}})" data-toggle="modal" data-target="#myModal" href="">Change Image</a>
					</div>
				</div>
				@endforeach
				
			</div>
		</div>               
	</div>    
	<footer class="pdf">    
	  <div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
					<img class="footer-image" src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
				</div>
				<!-- <div class="col-md-9 col-sm-9 col-xs-12 footer-height text-right">
					<div class="footer-content">
						<h1>FRANCE</h1>
						<h3>April 08 2017</h3>
					</div>                        
				</div> -->
			</div>                
		</div>          		
	  </div>          		
	</footer>      
</section> 
<!-- Section End -->
