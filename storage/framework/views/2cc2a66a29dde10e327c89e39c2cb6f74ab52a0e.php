<!-- Section Start -->	
    <table class="padd-left">
		<tr style="">
            <td style="width:60%;vertical-align: top;padding-left:15px;">
				<h1 style="font-size: 50px;color:#000;"><?php echo e($data->title); ?></h1> <br />
				<table style="padding-left: 0 !important">
					<?php foreach($data->detailitineraryDatas as $detail_itineraryData): ?>
					<tr>
						<td>
						<b style="font-weight:800 !important;color:#444;"><?php $dates="$detail_itineraryData->event_date"; $date=date_create_from_format("Y-m-d","$dates");
						echo date_format($date,"F d");?></b>
						</td><br /><br />
					</tr>
					<tr>	
						<td style="padding-left:20px;padding-top:10px;line-height:15px">
							<?php echo nl2br($detail_itineraryData->description); ?><br />
						</td>
					</tr>
					<?php endforeach; ?>	
				</table>
            </td>
            <td style="width:40%;text-align:right">
				<?php foreach($data->detailitineraryImages as $detailitineraryImage): ?>

    
                <img src="<?php echo e(url('/')); ?>/<?php echo trim($detailitineraryImage->image); ?>" alt="" title="" style="width:220px; height:140px;" /><br />

				<?php endforeach; ?>
                
            </td>
		</tr>
    </table>
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;">
                <img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" style="width:150px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>