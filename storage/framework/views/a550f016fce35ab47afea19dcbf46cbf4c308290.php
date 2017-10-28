
<div class="book-content right-content-page">
	<h2><?php echo e($data->title); ?></h2>
	<div class="left-content">	
		<table class="itinerary" style="font-size:10px;">
			<?php foreach($data->itineraryData as $itineraryValue): ?>
			<tr>
				<td style="width:70px;vertical-align:top;padding-bottom:10px;"><?php $dates="$itineraryValue->event_date";$date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"F d"); ?>:</td>
				<td style="vertical-align:top;padding-bottom:10px;"><?php echo nl2br($itineraryValue->description); ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div class="right-image">
		<?php foreach($data->itineraryImages as $itineraryImage): ?>
		<img class="right-pic zoom-this" src="<?php echo e(url('/')); ?>/<?php echo trim($itineraryImage->image); ?>" alt="" title="">
		<?php endforeach; ?>
		
	</div>
</div>

<div class="footer">
	<img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
</div>
<span class="page-number"><?php echo e($data->page); ?></span>