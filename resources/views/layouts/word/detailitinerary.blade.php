<div class=detailitinerarysection>
<table width=100%>
		<tr style="">
            <td style="width:60%;vertical-align: top;padding-left:15px;">
				<h1 style="font-size: 30px;color:#000;">{{$data->title}}</h1> <br />
				<table>
					@foreach($data->detailitineraryDatas as $detail_itineraryData)
					<tr>
						<td height=8>
						<b style="font-weight:600;color:#444;"><?php $dates="$detail_itineraryData->event_date"; $date=date_create_from_format("Y-m-d","$dates");
						echo date_format($date,"M d");?></b>
						</td>
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
                <img src="{{ url('/') }}/<?php echo trim($detailitineraryImage->image); ?>" alt="" title="" width="220" height="130" /><br />
				@endforeach

			
                
            </td>
		</tr>
		
    </table>
	

  <table id='hrdftrtbl' border='0' cellspacing='0' cellpadding='0'>
    <tr>
    <td>
    <div style='mso-element:footer' id="dtf1"><span style='position:relative;z-index:-1'> 
       <img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($data->logo); ?>" alt="" title="" width="150" height="50" />
        <span style='mso-no-proof:yes'></span></span>
           <p class='MsoFooter'>
           <span style='mso-tab-count:2'></span>
        
		</p>
    </div>

        <div style='mso-element:footer' id="fdtf1">
        <p class='MsoFooter'></p>
    </div>

    </td></tr>
    </table>	
			
<br clear=all style='page-break-before:always;
mso-break-type:section-break' />