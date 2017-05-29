
<div class="book-content right-page" style="padding-top: 100px;">
	
	<?php foreach($data->travel_agent as $travelagent) { ?>
	<div class="last-image">
		<img class="left-pic zoom-this" src="<?php echo url($data->upload_path);?>/<?php echo trim($travelagent->profile_image); ?>" alt="" title="">
	</div>
	<div class="last-content">
		
		<p><b>YOUR TRAVEL AGENT IN <?php echo $travelagent->place; ?></b><br />
			<?php echo nl2br($travelagent->name); ?><br/>
		
			<img src="<?php echo url ($data->upload_path);?>/<?php echo trim($travelagent->logo); ?>" style="height: 40px;width: 150px;padding-top:10px;" alt="" title="">						
		</p>
	</div>
	<?php } ?>

<span class="page-number"><?php echo e($data->page); ?></span>