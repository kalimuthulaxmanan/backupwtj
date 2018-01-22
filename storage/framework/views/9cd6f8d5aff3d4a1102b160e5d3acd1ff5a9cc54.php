<div class="book-content index-page">
	<?php foreach($data->frontImages as $frontImage): ?>
	<img src="<?php echo e(url('/')); ?>/<?php echo trim($frontImage->image); ?>" width="100%" alt="" title="" />
	<img class="footer-image right" src="<?php echo e(url('/')); ?>/<?php echo e($data->upload_path); ?>/<?php echo trim($data->signature); ?>" alt="" title="" style="width:135px;height:35px;position:absolute;top:355px;left:10px;" />
	<?php endforeach; ?>
</div>

<div class="index-footer">
	<div class="left">
		<?php if($data->additional_logo!=""): ?>
		<img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->additional_logo); ?>" alt="" title="" style="margin-bottom:15px;" />
	    <?php endif; ?>
		<img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" style="clear:left" />
	</div>
	<div class="right">
		<h1 style="font-size:80px;"><?php echo $data->country; ?></h1>
		<span class="date" style="font-size:16px;color:#999;"><?php  $dates="$data->start_date"; $date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"M d, Y");?> - <?php $datesend="$data->end_date"; $date=date_create_from_format("Y-m-d","$datesend");echo date_format($date,"M d, Y");?></span>
	</div>
</div>
<span class="page-number"><?php echo e($data->page); ?></span>