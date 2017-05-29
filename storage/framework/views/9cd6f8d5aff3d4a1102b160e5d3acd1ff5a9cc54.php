
<div class="book-content index-page">
	<?php foreach($data->frontImages as $frontImage): ?>
	<img src="<?php echo e(url('/')); ?>/<?php echo trim($frontImage->image); ?>" width="100%" alt="" title="" />
	<?php endforeach; ?>
</div>

<div class="index-footer">
	<div class="left">
		<img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
	</div>
	<div class="right">
		<h1><?php echo $data->place; ?></h1>
		<span class="date"><?php  $dates="$data->start_date"; $date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"M d, Y");?> - <?php $datesend="$data->end_date"; $date=date_create_from_format("Y-m-d","$datesend");echo date_format($date,"M d, Y");?></span>
	</div>
</div>
<span class="page-number"><?php echo e($data->page); ?></span>