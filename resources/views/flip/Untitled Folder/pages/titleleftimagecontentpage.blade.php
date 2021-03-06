
<div class="book-content">
	<p class="mt-25"><b>{{$data->itinerary_date_with_title}}</b></p>
	<h2>{{$data->title}}</h2>
	
	<div class="left-image"> 
	@foreach($data->contentImages as $contentImage )	
		<img class="left-pic zoom-this" src="{{url('/')}}/{{$data->upload_path}}<?php echo trim($contentImage->image); ?>">
	@endforeach
	</div>
	
	<div class="right-content">
		<p>{!!nl2br($data->content)!!}</p>
	</div>
	
	
	
</div>

<div class="footer">
	<img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
</div>

<span class="page-number">{{$data->page}}</span>