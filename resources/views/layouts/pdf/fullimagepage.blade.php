<!-- Section Start -->
	<div style="width:100%;position:relative;" >
		@foreach($data->fullImages as $fullimage)
		<img src="{{ url('/') }}/<?php echo trim($fullimage->image); ?>" alt="" title="" style="width:100%;position:absolute;height:900px;"/>
		@endforeach
	</div>
    <table style="height:120px;position:absolute;bottom:0px;">
		<tr style="">
            <td style="width:50%;text-align:right">
				
                <img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($data->signature); ?>" alt="" title="" style="width:200px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
    
	
	<div style="page-break-after: always;"></div>