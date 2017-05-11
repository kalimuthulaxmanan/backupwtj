
<div class="book-content">
	<h2>{{$data->title}}</h2>
	<div class="left-content">
		<p style="line-height:25px;">
			@foreach($data->detailitineraryDatas as $detail_itineraryData)
			&nbsp; &nbsp; &nbsp; - &nbsp; <?php $dates=$detail_itineraryData->event_date; $date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"M d");?>: {!!nl2br($detail_itineraryData->description)!!}<br>
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