
<div class="book-content right-content-page">
	<h2>{{$data->title}}</h2>
	<div class="left-content">	
		<table class="itinerary" style="font-size:10px;">
			@foreach($data->itineraryData as $itineraryValue)
			<tr>
				<td style="width:70px;vertical-align:top;padding-bottom:10px;"><?php $dates="$itineraryValue->event_date";$date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"F d"); ?>:</td>
				<td style="vertical-align:top;padding-bottom:10px;">{!!nl2br($itineraryValue->description)!!}</td>
			</tr>
			@endforeach
		</table>
	</div>
	<div class="right-image">
		@foreach($data->itineraryImages as $itineraryImage)
		<img class="right-pic zoom-this" src="{{ url('/') }}/<?php echo trim($itineraryImage->image); ?>" alt="" title="">
		@endforeach
		
	</div>
</div>

<div class="footer">
	<img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
</div>
<span class="page-number">{{$data->page}}</span>