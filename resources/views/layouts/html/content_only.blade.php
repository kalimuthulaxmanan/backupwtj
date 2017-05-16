<!-- Section Start -->
<section class="">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<h1 class="font-28">{{$data->title}}</h1>     
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12 mt-25 sales-content">
				<p>{!!nl2br($data->content)!!}</p>				
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