<div class="fullwidth-image">
	<?php foreach($data->fullImages as $fullimage): ?>
	<img src="<?php echo e(url('/')); ?>/<?php echo trim($fullimage->image); ?>" alt="" title="" />
	<?php endforeach; ?>
	<?php if(trim($data->full_page_image)!=""): ?>
	<img src="<?php echo e(url('/')); ?>/<?php echo e($data->upload_path); ?>/<?php echo trim($data->full_page_image); ?>" class="footer" alt="" title="" />
	<?php endif; ?>
</div>
<span class="page-number"><?php echo e($data->page); ?></span>