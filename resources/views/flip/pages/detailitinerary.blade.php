
<div class="book-content">
	<h2>{{$data->title}}</h2>
	<div class="left-content">
		<p style="line-height:25px;">
			@foreach($data->detailitineraryDatas as $detail_itineraryData)
			&nbsp; &nbsp; &nbsp; - &nbsp; {{$detail_itineraryData->event_date}}: {!!nl2br($detail_itineraryData->description)!!}<br>
			@endforeach
							 
		</p>
	</div>
	<div class="right-image">
			@foreach($data->detailitineraryImages as $detailitineraryImage)
		<img class="right-pic zoom-this" src="{{url('/')}}/{{$data->upload_path}}<?php echo trim($detailitineraryImage->image); ?>" alt="" title="">
		@endforeach
		
	</div>
</div>

<div class="footer">
	<img src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
</div>
<span class="page-number">{{$data->page}}</span>