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
		<?php foreach($data1 as $pages): ?>
					
						<?php if($pages->show_summery === 1): ?>
					
						<tr>
						<td style="padding-left: 180px;width: 50%;font-size: 15px;line-height: 20px;"><?php echo e($pages->title); ?></td>
						<td style="width: 30%;font-size: 15px;line-height: 20px;">Page <?php
						$num = $pages->content_order+2;
						$num_padded = sprintf("%02d", $num);
						echo $num_padded;
						?></td>
						</tr>
					<?php endif; ?>
					<?php endforeach; ?>
	</table>
	
    <table style="height:80px;position:absolute;bottom:0px;">
		<tr style="">
            <td style="width:50%;vertical-align:middle; padding-left: 15px; padding-bottom: 0px !important;">
                <span>Date of release:<?php $dates="$data->date_of_release";$date=date_create_from_format("Y-m-d","$dates");echo date_format($date,"F d, Y"); ?></span>
            </td>
            <td style="width:50%;text-align:right; padding-right: 15px;">
                <img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" style="width:150px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>