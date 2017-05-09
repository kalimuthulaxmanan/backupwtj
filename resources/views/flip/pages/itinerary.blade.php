
<div class="book-content">
	<h2>{{$data->title}}</h2>
	<div class="left-content">
		<p style="line-height:25px;">	
			@foreach($data->itineraryData as $itineraryValue)
			{{$itineraryValue->event_date}}: <strong>{{$itineraryValue->description}}</strong><br />
			@endforeach
			
		</p>
	</div>
	<div class="right-image">
		@foreach($data->itineraryImages as $itineraryImage)
		<img class="right-pic zoom-this" src="{{url('/')}}/{{$data->upload_path}}<?php echo trim($itineraryImage->image); ?>" alt="" title="">
		@endforeach
		
	</div>
</div>

<div class="footer">
	<img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
</div>
<span class="page-number">{{$data->page}}</span>