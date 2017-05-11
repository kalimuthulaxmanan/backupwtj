<!-- Section Start -->	
    <table class="padd-left">
		<tr style="">
            <td style="width:60%;vertical-align: top;">
				<h1 style="font-size: 50px;">{{$data->title}}</h1> <br />
				@foreach($data->detailitineraryDatas as $detail_itineraryData)
				<span><b>{{$detail_itineraryData->event_date}}</b></span><br /><br />
				<span>
					&nbsp; &nbsp; &nbsp; - &nbsp; {!!nl2br($detail_itineraryData->description)!!}<br />
					
					</span> 
			@endforeach	
            </td>
            <td style="width:40%;text-align:right">
				@foreach($data->detailitineraryImages as $detailitineraryImage)
                <img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($detailitineraryImage->image); ?>" alt="" title="" style="width:300px;" /><br />
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