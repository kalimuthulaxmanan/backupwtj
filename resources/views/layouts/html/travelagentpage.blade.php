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

	<div class="row">
        <?php foreach($data->travel_agent as $travelagent) { ?>
		<div class="col-md-12" style="margin-bottom: 15px">
			<div class="col-md-2 col-sm-2 col-xs-12">
				<img class="travelagent" src="<?php echo url($data->upload_path);?>/<?php echo trim($travelagent->profile_image); ?>" alt="" title="" />
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<p><b>YOUR TRAVEL AGENT IN <?php echo $travelagent->place; ?></b><br>
				<?php echo nl2br($travelagent->name);?>
			</div>
		</div>
        <?php } ?>
	</div>

		<div class="travel-footer" style="position: absolute;text-align: center; width: 100%; bottom: 10px; padding: 0 15px;">
			@if(trim($data->travel_agent[0]->additional_logo!=""))
                <?php $additionallogo=explode('|||',$data->travel_agent[0]->additional_logo);?>
				@for($i=0;$i<=2;$i++)
					<img src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo trim($additionallogo[$i]); ?>" alt="" title="" style="width:150px;height:50px;" />
				@endfor
			@endif
			@if(trim($data->travel_agent[0]->footer_sign)!="")
				<img src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo trim($data->travel_agent[0]->footer_sign); ?>" alt="" title="" style="clear:left;margin-top:15px;width:100%;height:50px;" />
			@endif
		</div>
	
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