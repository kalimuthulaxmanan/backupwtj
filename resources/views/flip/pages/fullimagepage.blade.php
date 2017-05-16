<div class="fullwidth-image">
	@foreach($data->fullImages as $fullimage)
	<img src="<?php echo trim($fullimage->image); ?>" alt="" title="" />
	@endforeach
	<img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($data->signature); ?>" class="footer" alt="" title="" />
</div>
<span class="page-number">{{$data->page}}</span>