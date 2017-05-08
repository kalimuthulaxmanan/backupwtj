<!-- Section Start -->
<section class="">        
	<div class="fullwidthimage change-image">
		@foreach($data->fullImages as $fullimage)
		<img src="{{url('/')}}/{{$data->upload_path}}<?php echo trim($fullimage->image); ?>" id ="image{{$fullimage->id}}" alt="" title="" />
		<div class="img-overlay">
			<a onclick="newFunction('image{{$fullimage->id}}',{{$fullimage->id}})" data-toggle="modal" data-target="#myModal" href="">Change Image</a>
		</div>
		@endforeach
	</div>
</section>	
<!-- Section End -->