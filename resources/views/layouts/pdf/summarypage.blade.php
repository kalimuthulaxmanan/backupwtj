 <!-- Section Start -->
    <table style="margin-top:150px;">
		<tr style="">
            <td colspan="2" style="text-align:center">                
				Distinguished guests:{{$data->distinguished_guests}}<br>
				Agency: {{$data->agency}}<br>
				Agent: {{$data->agent}}<br /><br />
                <h5 style="font-weight: 600 !important;">
                    <b>Duration: {{$data->duration_day}} day / {{$data->duration_night}} nights<br>
				Number of Persons:{{$data->no_of_persons}}</b>
                </h5><br />
            </td>
		</tr>
        <tr><td colspan="2" style="text-align:center"><h1 style="font-size: 25px;font-weight: 600;letter-spacing: 1px;color: #000">Summary<br /><br /></h1></td></tr>
		<tr class="summary-left">
			<td>Welcome in France</td>
			<td>page 04</td>
		</tr>
		<tr class="summary-left">
			<td>Your itinerary</td>
			<td>page 06</td>
		</tr>
		<tr class="summary-left">
			<td>Champagne</td>
			<td>page 10</td>
		</tr>
		<tr class="summary-left">
			<td>Paris</td>
			<td>page 12</td>
		</tr>
		<tr class="summary-left">
			<td>Detailed itinerary</td>
			<td>page 18</td>
		</tr>
		<tr class="summary-left">
			<td>Sales and terms conditions</td>
			<td>page 19</td>
		</tr>
	</table>
	
    <table style="height:120px;position:absolute;bottom:0px;">
		<tr style="">
            <td style="width:50%;vertical-align:middle;">
                <span>Date of release:<?php $dates="$data->date_of_release";$date=date_create_from_format("Y-m-d","$dates");echo date_format($date,"M d, Y"); ?></span>
            </td>
            <td style="width:50%;text-align:right">
                <img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" style="width:200px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>