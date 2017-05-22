<div class=contentImagesection>	
	<p style="margin-top:22px;"><b style="font-weight:800;font-size:15px;color:#000">{{$data->itinerary_date_with_title}}</b></p>
    <h1 style="font-size:30px;font-weight: 800px !important;">{{$data->title}}</h1>
      
    <table>
		<tr style="">
            <td style="width:30%;vertical-align:top;padding-top:8px;padding-left:15px;">  
				@foreach($data->contentImages as $contentImage )
               <img src="{{ url('/') }}/<?php echo trim($contentImage->image); ?>" alt="" title=""  width="225" height="150" /><br /><br />
               @endforeach
            </td>
            <td style="width:70%;vertical-align:top; padding-right: 25px;">                
                <span class="padd-left" style="font-size: 14px">
                   {!!nl2br($data->content)!!}
                </span><br />
            </td>
		</tr>
    </table>
<div style='mso-element:footer' id="if1">
<p class="MsoFooter">	
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;">
                <img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" width="150" height="50" />
            </td>
		</tr>
    </table>	
</p>
</div>	
		
	<br clear=all style='page-break-before:always;
mso-break-type:section-break' />