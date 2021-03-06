<!-- Section Start -->
    <table style="width: 100%;">
		<tr>
            <td style="padding-left:15px;padding-top:15px;">
                <h1 style="font-size:55px; font-weight: 800px !important;color:#000">{{$data->title}}</h1><br /><br />
            </td>
        </tr>
	</table>
    <table style="width: 100%;">
        <tr style="">
            <td style="width:30%;vertical-align:top;padding-top:5px;padding-left:15px;">  
                @foreach($data->contentImages as $contentImage )
                <img src="{{ url('/') }}/<?php echo trim($contentImage->image); ?>" alt="" title=""  style="width:225px;height:150px; margin-bottom: 20px;clear: both;"/>
                @endforeach
            </td>
            <td style="width:70%;vertical-align:top; padding-right: 25px;">                
                <span class="padd-left">
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