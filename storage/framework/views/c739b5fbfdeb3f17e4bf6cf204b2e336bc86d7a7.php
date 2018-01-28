<!-- Section Start -->
	<div style="width:100%;position:relative;" >
		<?php foreach($data->fullImages as $fullimage): ?>
		<img src="<?php echo e(url('/')); ?>/<?php echo trim($fullimage->image); ?>" alt="" title="" style="width:100%;position:absolute;height:750px;"/>
		<?php endforeach; ?>
	</div>
    <table style="height:120px;position:absolute;bottom:0px;">
		<tr style="">
            <td style="width:50%;text-align:right; padding-right: 15px;">	
               	<?php if(trim($data->full_page_image)!=""): ?>
                <img src="<?php echo e(url('/')); ?>/<?php echo e($data->upload_path); ?>/<?php echo trim($data->full_page_image); ?>" alt="" title="" style="width:150px;height:50px;" />
				<?php endif; ?>
            </td>
		</tr>
    </table>
    <!-- Section End -->
    
	<div style="page-break-after: always;"></div>