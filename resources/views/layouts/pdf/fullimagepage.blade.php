<!-- Section Start -->
	<div style="width:100%;position:relative;" >
		@foreach($data->fullImages as $fullimage)
		<img src="{{ url('/') }}/<?php echo trim($fullimage->image); ?>" alt="" title="" style="width:100%;position:absolute;height:750px;"/>
		@endforeach
	</div>
    <table style="height:120px;position:absolute;bottom:0px;">
		<tr style="">
            <td style="width:50%;text-align:right; padding-right: 15px;">	
                <img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($data->signature); ?>" alt="" title="" style="width:150px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
    
	<div style="page-break-after: always;"></div>