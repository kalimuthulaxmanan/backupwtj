<!-- Section Start -->
<style type="text/css">
	.leftcontent-image img{
		width: 100%;
		height: 160px;
	}
</style>
<section class="">
	<div class="row">
		<div class="col-md-12">
			<div class="title">     
				<h1 class="left-title"><?php echo e($data->title); ?></h1>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">  
				<?php foreach($data->contentImages as $contentImage ): ?>
				<div class="leftcontent-image change-image">
					<img src="<?php echo e(url('/')); ?>/<?php echo trim($contentImage->image); ?>" id ="image<?php echo e($contentImage->id); ?>" alt="" title="" />
					<div class="img-overlay">
						<a onclick="newFunction('image<?php echo e($contentImage->id); ?>',<?php echo e($contentImage->id); ?>)" data-toggle="modal" data-target="#myModal" href="">Change Image</a>
					</div>
				</div><br />
				<?php endforeach; ?>
				
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<p class="bold">
				<?php echo nl2br($data->content); ?>

				</p>                
			</div>
		</div>                
	</div>  
	<footer class="pdf">    
	  <div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
					<img class="footer-image" src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
				</div>
				<!-- <div class="col-md-9 col-sm-9 col-xs-12 footer-height text-right">
					<div class="footer-content">
						<h1>FRANCE</h1>
						<h3>April 08 2017</h3>
					</div>                        
				</div> -->
			</div>                
		</div>          		
	  </div>          		
	</footer>      
</section> 
<!-- Section End -->