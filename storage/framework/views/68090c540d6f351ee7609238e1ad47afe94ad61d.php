
<div class="book-content right-content-page">
	<h2><?php echo e($data->title); ?></h2>
	<div class="left-content">
		<p style="line-height:20px;">
			<?php foreach($data->detailitineraryDatas as $detail_itineraryData): ?>
			&nbsp; &nbsp; &nbsp; - &nbsp; <?php $dates=$detail_itineraryData->event_date; $date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"F d");?>: <?php echo nl2br($detail_itineraryData->description); ?><br>
			<?php endforeach; ?>
							 
		</p>
	</div>
	<div class="right-image">
			<?php foreach($data->detailitineraryImages as $detailitineraryImage): ?>
		<img class="right-pic zoom-this" src="<?php echo e(url('/')); ?>/<?php echo trim($detailitineraryImage->image); ?>" alt="" title="">
		<?php endforeach; ?>
		
	</div>
</div>

<div class="footer">
	<img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
</div>
<span class="page-number"><?php echo e($data->page); ?></span>