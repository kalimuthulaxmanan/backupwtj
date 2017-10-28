
<div class="book-content right-content-page">
	<p class="pt-10"><b><?php echo e($data->itinerary_date_with_title); ?></b></p>
	<h2><?php echo e($data->title); ?></h2>
	
	<div class="left-image"> 
	<?php foreach($data->contentImages as $contentImage ): ?>	
		<img class="left-pic zoom-this" src="<?php echo e(url('/')); ?>/<?php echo trim($contentImage->image); ?>">
	<?php endforeach; ?>
	</div>
	
	<div class="right-content">
		<?php $data->content=strip_tags($data->content, '<br><b><p><a>\n');    ?>
		<p><?php echo nl2br($data->content); ?></p>
	</div>
	
	
	
</div>

<div class="index-footer">
	<img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
</div>

<span class="page-number"><?php echo e($data->page); ?></span>