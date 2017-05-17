 <!-- Section Start -->
    <table style="margin-top:150px;">
		<tr style="">
            <td colspan="2" style="text-align:center; font-size: 13px !important;">                
				Distinguished guests:<?php echo e($data->distinguished_guests); ?><br>
				Agency: <?php echo e($data->agency); ?><br>
				Agent: <?php echo e($data->agent); ?><br /><br />
                <h5 style="font-size: 15px !important;font-weight: 600 !important;">
                    <b>Duration: <?php echo e($data->duration_day); ?> day / <?php echo e($data->duration_night); ?> nights<br>
				Number of Persons:<?php echo e($data->no_of_persons); ?></b>
                </h5><br />
            </td>
		</tr>
        <tr><td colspan="2" style="text-align:center"><h1 style="font-size: 30px;font-weight: 500 !important;letter-spacing: 1px;color: #000">Summary<br /><br /></h1></td></tr>
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
	
    <table style="height:80px;position:absolute;bottom:0px;">
		<tr style="">
            <td style="width:50%;vertical-align:middle; padding-left: 15px; padding-bottom: 0px !important;">
                <span>Date of release:<?php $dates="$data->date_of_release";$date=date_create_from_format("Y-m-d","$dates");echo date_format($date,"M d, Y"); ?></span>
            </td>
            <td style="width:50%;text-align:right; padding-right: 15px;">
                <img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" style="width:150px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>