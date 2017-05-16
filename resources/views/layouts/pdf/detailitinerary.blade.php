<!-- Section Start -->	
    <table class="padd-left">
		<tr style="">
            <td style="width:60%;vertical-align: top;">
				<h1 style="font-size: 50px;color:#000;">{{$data->title}}</h1> <br />
				<table>
					@foreach($data->detailitineraryDatas as $detail_itineraryData)
					<tr>
						<td>
						<b style="font-weight:600;color:#444;"><?php $dates="$detail_itineraryData->event_date"; $date=date_create_from_format("Y-m-d","$dates");
						echo date_format($date,"M d");?></b>
						</td><br /><br />
					</tr>
					<tr>	
						<td style="padding-left:20px;padding-top:10px;line-height:20px">
							{!!nl2br($detail_itineraryData->description)!!}<br />
						</td>
					</tr>
					@endforeach	
				</table>
            </td>
            <td style="width:40%;text-align:right">
				@foreach($data->detailitineraryImages as $detailitineraryImage)
                <img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($detailitineraryImage->image); ?>" alt="" title="" style="width:225px;height:140px;" /><br />
				@endforeach
                
            </td>
		</tr>
    </table>
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;">
                <img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" style="width:200px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>