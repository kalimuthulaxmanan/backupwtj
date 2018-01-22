<!-- Section Start -->
<style type="text/css">
	.index-image img{
		width: 100%;
		height: 500px;
	}
</style>
<section class="">        
	<div class="index-image change-image">
	<?php foreach($data->frontImages as $frontImage): ?>
		
		<img src="<?php echo e(url('/')); ?>/<?php echo trim($frontImage->image); ?>" id="image<?php echo e($frontImage->id); ?>" alt="" title="" />
			<img class="footer-image right" src="<?php echo e(url('/')); ?>/<?php echo e($data->upload_path); ?>/<?php echo trim($data->signature); ?>" alt="" title="" style="width:150px;height:50px;position:absolute;top:440px;left:10px;" />
		<div class="img-overlay">
			<a onclick="newFunction('image<?php echo e($frontImage->id); ?>',<?php echo e($frontImage->id); ?>)" data-toggle="modal" data-target="#myModal" href="">Change Image</a>
		</div>
	<?php endforeach; ?>
	</div>

	<footer class="pdf" style="height:115px">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3 col-sm-3 col-xs-12 footer-height" style="height:115px">
					<?php if(trim($data->additional_logo)!=""): ?>
					<img class="footer-image" src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->additional_logo); ?>" alt="" title="" style="margin-bottom:15px;top:0"/>
					<?php endif; ?>
					<img class="footer-image" src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
				</div>
				<div class="col-md-9 col-sm-9 col-xs-12 footer-height text-right">
					<div class="footer-content">
						<h1 style="font-size:100px"><?php echo $data->country; ?></h1>
						<h3 style="font-size: 25px"><?php  $dates="$data->start_date"; $date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"M d, Y");?> - <?php $datesend="$data->end_date"; $date=date_create_from_format("Y-m-d","$datesend");echo date_format($date,"M d, Y");?></h3>
					</div>                        
				</div>
			</div>                
		</div>       		
	</footer>
</section>	
<!-- Section End -->