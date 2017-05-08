<!-- Section Start -->
<style type="text/css">
	.index-image img{
		width: 100%;
		height: 500px;
	}
</style>
<section class="">        
	<div class="index-image change-image">
	@foreach($data->frontImages as $frontImage)
		<img src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo trim($frontImage->image); ?>" id="image{{$frontImage->id}}" alt="" title="" />
		
		<div class="img-overlay">
			<a onclick="newFunction('image{{$frontImage->id}}',{{$frontImage->id}})" data-toggle="modal" data-target="#myModal" href="">Change Image</a>
		</div>
	@endforeach
	</div>

	<footer class="pdf">    
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
					<img class="footer-image" src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
				</div>
				<div class="col-md-9 col-sm-9 col-xs-12 footer-height text-right">
					<div class="footer-content">
						<h1><?php echo $data->place; ?></h1>
						<h3><?php echo $data->start_date;?>/ <?php echo $data->end_date;?></h3>
					</div>                        
				</div>
			</div>                
		</div>       		
	</footer>
</section>	
<!-- Section End -->