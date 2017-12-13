<style>
.text-center{
	text-align:center;
}
.text-left{
	text-align:left;
}
</style>

<div class="table-contents text-center">  
	<div class="table-header">

	</div>
	<div class="table-body">
		<h3 style="font-size:24px;font-weight:500;">Summary Continued</h3>
		<table class="text-left" style="width: 100%">
				<?php $i=0; ?>
				<?php foreach($data1 as $pages): ?>

				<?php if($pages->show_summery == 1): ?>
				<?php if($i < 9){ ?> 
				<tr>
				<td><a href="#" style="color:#757575;background:none;"><?php echo mb_substr($pages->title, 0,23); ?></a></td>
				<td>Page <?php
				$num = $pages->content_order+session('pageadd');
				$num_padded = sprintf("%02d", $num);
				echo $num_padded;
				?></td>
				</tr>
				<?php $i++; } ?>
			<?php endif; ?>
			<?php endforeach; ?>
		</table>
	</div>
</div>
<div class="index-footer summary-footer">
	<div class="left">
		<p class="bold" style="padding-left: 30px;">Date of release: <?php $dates="$data->date_of_release";$date=date_create_from_format("Y-m-d","$dates");echo date_format($date,"F d, Y"); ?></p>
	</div>
	<div class="right">
		<img class="footer-image right" src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" />
	</div>
</div>  
<span class="page-number"><?php echo e($data->page); ?></span>