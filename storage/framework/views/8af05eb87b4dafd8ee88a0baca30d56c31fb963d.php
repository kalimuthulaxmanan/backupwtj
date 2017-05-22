<div class=Section1>
<?php foreach($data->fullImages as $fullimage): ?>
<img width=719 height=719
 src="<?php echo e(url('/')); ?>/<?php echo trim($fullimage->image); ?>"/>
<?php endforeach; ?>
</div>

<br clear=all style='page-break-before:always;
mso-break-type:section-break' />