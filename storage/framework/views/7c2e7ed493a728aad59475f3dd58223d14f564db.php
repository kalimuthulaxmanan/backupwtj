    <!-- Section Start -->
    <table style="width: 100%;">
		<tr>
            <td style="padding-left:15px;">
				<p style="margin-top:22px;"><b style="font-weight:600 !important;font-size:15px;color:#000"><?php echo e($data->itinerary_date_with_title); ?></b></p>
                <h1 style="font-size:50px;font-weight: 800px !important;line-height: 40px;margin-top: 10px;color:#000"><?php echo e($data->title); ?></h1><br /><br />
            </td>
		</tr>
	</table>
    <table style="width: 100%;">
		<tr style="">
            <td style="width:30%;vertical-align:top;padding-top:5px;padding-left:15px;">  
				<?php foreach($data->contentImages as $contentImage ): ?>
                <img src="<?php echo e(url('/')); ?>/<?php echo trim($contentImage->image); ?>" alt="" title=""  style="width:225px;height:150px;margin-bottom: 20px;clear: both;" />
                <?php endforeach; ?>
            </td>
            <td style="width:70%;vertical-align:top; padding-right: 25px;">                
                <span class="padd-left">
                   <?php echo nl2br($data->content); ?>

                </span><br />
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