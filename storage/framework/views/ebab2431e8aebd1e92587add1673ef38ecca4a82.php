<!-- Section Start -->
<section class="">        
	<div class="fullwidthimage change-image">
		<?php foreach($data->fullImages as $fullimage): ?>
		<img src="<?php echo e(url('/')); ?>/<?php echo trim($fullimage->image); ?>" id ="image<?php echo e($fullimage->id); ?>" alt="" title="" />
		<div class="img-overlay">
			<a onclick="newFunction('image<?php echo e($fullimage->id); ?>',<?php echo e($fullimage->id); ?>)" data-toggle="modal" data-target="#myModal" href="">Change Image</a>
		</div>
		<?php endforeach; ?>
	</div>
	<footer class="pdf">    
	  <div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 col-sm-6 col-xs-12 footer-height">
					<div class="footer-content left"></div>                      
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 footer-height text-right">
					<?php if(trim($data->full_page_image)!=""): ?>
					<img class="footer-image right" src="<?php echo e(url('/')); ?>/<?php echo e($data->upload_path); ?>/<?php echo trim($data->full_page_image); ?>" alt="" title="" />
					<?php endif; ?>
				</div>
			</div>               
		</div>          		
	  </div>          		
	</footer>      
</section>	
<!-- Section End -->