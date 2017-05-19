<!-- Section Start -->	
    <table class="padd-left">
		<tr style="">
            <td style="width:60%;vertical-align: top;padding-left:15px;">
				<h1 style="font-size: 50px;color:#000">{{$data->title}}</h1> <br />
				<table class="itinerary" style="padding-left: 0 !important">
					@foreach($data->itineraryData as $itineraryValue)	
					<tr>
						<td style="width:40;padding-bottom:10px;vertical-align:top;line-height:20px;">
							<span><b><?php $dates="$itineraryValue->event_date";$date=date_create_from_format("Y-m-d","$dates");
							echo date_format($date,"M d"); ?>:</b></span>
						</td>
						<td style="padding-bottom:10px;vertical-align:top;line-height:20px;">
							<span><b>{!!nl2br($itineraryValue->description)!!}</b></span>
						</td><br /><br />
					</tr>
					@endforeach	
				</table>
            </td>
            <td style="width:40%;text-align:right;">
				@foreach($data->itineraryImages as $itineraryImage)
                <img src="{{ url('/') }}/<?php echo trim($itineraryImage->image); ?>" alt="" title="" style="width:220px;height:140px;clear: both;" />
				@endforeach               
            </td>
		</tr>
    </table>
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;">
                <img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($data->logo); ?>" alt="" title="" style="width:150px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>