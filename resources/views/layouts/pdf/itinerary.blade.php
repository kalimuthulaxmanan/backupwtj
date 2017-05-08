<!-- Section Start -->	
    <table class="padd-left">
		<tr style="">
            <td style="width:60%;vertical-align: top;">
				<h1 style="font-size: 50px;">{{$data->title}}</h1> <br />
				@foreach($data->itineraryData as $itineraryValue)	
				<span><b>{{$itineraryValue->event_date}}: &nbsp;  &nbsp;  &nbsp; {{$itineraryValue->description}}</b></span><br /><br />
				@endforeach	
				
            </td>
            <td style="width:40%;text-align:right">
				@foreach($data->itineraryImages as $itineraryImage)
                <img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($itineraryImage->image); ?>" alt="" title="" style="width:300px;" /><br />
				@endforeach
               
            </td>
		</tr>
    </table>
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;">
                <img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($data->logo); ?>" alt="" title="" style="width:200px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>