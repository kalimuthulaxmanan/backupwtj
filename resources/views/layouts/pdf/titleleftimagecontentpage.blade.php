    <!-- Section Start -->
    <table style="width: 100%;">
		<tr>
            <td style="padding-left:15px;">
				<p style="margin-top:22px;"><b style="font-weight:600 !important;font-size:15px;color:#000">{{$data->itinerary_date_with_title}}</b></p>
                <h1 style="font-size:40px;font-weight: 700px !important;line-height: 40px;margin-top: 10px;color:#000">{!!ucfirst(strtolower(mb_substr($data->title, 0,55)))!!}</h1><br /><br />
            </td>
		</tr>
	</table>
    <table style="width: 100%;">
		<tr style="">
            <td style="width:30%;vertical-align:top;padding-top:5px;padding-left:15px;">  
				@foreach($data->contentImages as $contentImage )
                <img src="{{ url('/') }}/<?php echo trim($contentImage->image); ?>" alt="" title=""  style="width:225px;height:150px;margin-bottom: 20px;clear: both;" />
                @endforeach
            </td>
            <td style="width:70%;vertical-align:top; padding-right: 25px;">                
                <span class="padd-left">
				   <?php $data->content=strip_tags($data->content, '<br><b><p><a>\n');?>	
                   {!!nl2br($data->content)!!}
                </span><br />
            </td>
		</tr>
    </table>
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;">
                <img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" style="width:150px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>