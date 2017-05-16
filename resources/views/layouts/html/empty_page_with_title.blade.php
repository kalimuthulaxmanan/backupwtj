<!-- Section Start -->
<section class="title-page" style="background-color:<?php echo $data->empty_page_color; ?> !important;height:100vh!important;">  
	<div class="row"> 
		<div class="col-md-12">
			<div class="col-md-12 col-sm-12 col-xs-12 text-right">
				<div class="title title-padd">
					<h1 class="big-title">{{$data->title}}</h1> 
				</div>                        
			</div>
		</div> 
	</div>  
	<footer class="pdf">    
	  <div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 col-sm-6 col-xs-12 footer-height">
					<div class="footer-content left"></div>                      
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 footer-height text-right">
					<img class="footer-image right" src="{{ url('/') }}/{{$data->upload_path}}/<?php echo trim($data->signature); ?>" alt="" title="" />
				</div>
			</div>               
		</div>          		
	  </div>          		
	</footer>      
</section> 
<!-- Section End -->