<div class="fullwidth-image">
	@foreach($data->fullImages as $fullimage)
	<img src="{{ url('/') }}/<?php echo trim($fullimage->image); ?>" alt="" title="" />
	@endforeach
	@if(trim($data->full_page_image)!="")
	<img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($data->full_page_image); ?>" class="footer" alt="" title="" />
	@endif
</div>
<span class="page-number">{{$data->page}}</span>