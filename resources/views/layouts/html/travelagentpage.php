<!-- Section Start -->
<style>
.pt-100{
	padding-top: 100px;
}
img.travelagent{
	width: 90px;
	height:90px;
}
</style>
<section class="pt-100">
	
	<?php foreach($data->travel_agent as $travelagent) { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-2 col-sm-2 col-xs-12">
				<img class="travelagent" src="<?php echo url($data->upload_path);?>/<?php echo trim($travelagent->profile_image); ?>" alt="" title="" />
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<p><b>YOUR TRAVEL AGENT IN <?php echo $travelagent->place; ?></b><br />
				<?php echo $travelagent->name; ?><br />
				
				<img src="<?php echo url ($data->upload_path);?>/<?php echo trim($travelagent->logo); ?>" style="height: 40px;width: 200px;" alt="" title="" />						
			</div>
		</div>                
	</div>
	<br />
	<?php } ?>
	
	<!-- <footer class="pdf">    
	  <div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
					<img class="footer-image" src="images/fileimage/images/image21.jpg" alt="" title="" />
				</div>
				<div class="col-md-9 col-sm-9 col-xs-12 footer-height text-right">
					<div class="footer-content">
						<h1>FRANCE</h1>
						<h3>April 08 2017</h3>
					</div>                        
				</div>
			</div>                
		</div>          		
	  </div>          		
	</footer> -->      
</section> 
<!-- Section End -->