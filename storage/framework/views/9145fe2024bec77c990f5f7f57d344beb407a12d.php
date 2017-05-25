<div class="fullwidth-image">
	<?php foreach($data->fullImages as $fullimage): ?>
	<img src="<?php echo e(url('/')); ?>/<?php echo trim($fullimage->image); ?>" alt="" title="" />
	<?php endforeach; ?>
	<img src="<?php echo e(url('/')); ?>/<?php echo e($data->upload_path); ?>/<?php echo trim($data->signature); ?>" class="footer" alt="" title="" />
</div>
<span class="page-number"><?php echo e($data->page); ?></span>