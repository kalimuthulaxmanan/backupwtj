<!-- Section Start -->
    <table style="width:100%;height:100%;position:absolute;background-color:<?php echo $data->empty_page_color; ?>;">
		<tr style="">
            <td style="text-align:right; padding-right:20px">
				<h1 style="font-size:65px;color:#fff"><?php echo e($data->title); ?></h1>  
            </td>
		</tr>
    </table>
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;text-align:right;padding-right: 15px;">
                <img src="<?php echo e(url('/')); ?>/<?php echo e($data->upload_path); ?>/<?php echo trim($data->signature); ?>" alt="" title="" style="width:150px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>