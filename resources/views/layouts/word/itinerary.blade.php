<!-- Section Start -->	
<div class=itinerarySection>
    <table width=100% height=80%>
		<tr style="">
            <td width=470 style="vertical-align: top;padding-left:15px;">
				<h1 style="font-size: 50px;">{{$data->title}}</h1> <br />
				<table  class="itinerary">
					@foreach($data->itineraryData as $itineraryValue)
					<tr>
						<td style="width:80;padding-bottom:10px;vertical-align:top;line-height:20px;">
							<span><b><?php $dates="$itineraryValue->event_date";$date=date_create_from_format("Y-m-d","$dates");
							echo date_format($date,"M d"); ?>:</b></span><br />
						</td>
						<td style="width:250;padding-bottom:10px;vertical-align:top;line-height:20px;">
							<span><b>{{$itineraryValue->description}}</b></span><br/>
						</td><br /><br />
					</tr>
					@endforeach	
				</table>
            </td>
            <td width=249 style="text-align:right;">
				@foreach($data->itineraryImages as $itineraryImage)
                <img src="{{ url('/') }}/<?php echo trim($itineraryImage->image); ?>" alt="" title="" width="220" height="130"  /><br />
				@endforeach  
            </td>
		</tr>		
    </table>
	
<table id='hrdftrtbl' border='0' cellspacing='0' cellpadding='0'>
    <tr>
    <td>
    <div style='mso-element:footer' id='itf1'><span style='position:relative;z-index:-1'> 
       <img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" width="150" height="50" />
        <span style='mso-no-proof:yes'></span></span> 
           <p class='MsoFooter'>
           <span style= 'mso-tab-count:2'></span>
        </p>
    </div>



    
        <div style='mso-element:footer' id='fitf1'>
        <p class='MsoFooter'></p>
    </div>

    </td></tr>
    </table>		
	
	
    <!-- Section End -->	

	
	

	

<br clear=all style='page-break-before:always;
mso-break-type:section-break' />