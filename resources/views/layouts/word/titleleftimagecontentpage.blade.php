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
<table id='hrdftrtbl' border='0' cellspacing='0' cellpadding='0'>
    <tr>
    <td>
    <div style='mso-element:footer' id="if1"><span style='position:relative;z-index:-1'> 
       <img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" width="150" height="50" />
        <span style='mso-no-proof:yes'></span></span>
           <p class='MsoFooter'>
           <span style='mso-tab-count:2'></span>
        </p>
    </div>



    
        <div style='mso-element:footer' id="fif1">
        <p class='MsoFooter'></p>
    </div>

    </td></tr>
    </table>	
		
	<br clear=all style='page-break-before:always;
mso-break-type:section-break' />