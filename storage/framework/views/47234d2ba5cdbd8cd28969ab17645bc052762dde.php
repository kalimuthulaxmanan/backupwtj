
<div class="title-page" style="background-color:<?php echo $data->empty_page_color; ?> !important;">
	<h1><?php echo e($data->title); ?></h1> 
	<img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" class="index-footer" />
</div>
<span class="page-number"><?php echo e($data->page); ?></span>