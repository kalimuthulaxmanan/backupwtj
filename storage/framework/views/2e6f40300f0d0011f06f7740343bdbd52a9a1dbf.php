
<div class="book-content right-page" style="position:absolute;height:100%;width:100%">
  <div style="display:flex;align-items:center;height:calc(100% - 115px);">
	  <div>
	    <?php $i=1; ?>
		<?php foreach($data->travel_agent as $travelagent) { ?>
		<?php if($i<=3){ ?>  
		<div style="display:block;">
			<div class="last-image">
				<img class="left-pic zoom-this" src="<?php echo url($data->upload_path);?>/<?php echo trim($travelagent->profile_image); ?>" alt="" title="">
			</div>
			<div class="last-content">		
				<b>YOUR TRAVEL AGENT IN <?php echo $travelagent->place; ?></b>
				<p><?php echo nl2br($travelagent->name); ?><br/></p>
			</div>
		</div>
		  <?php }?>
		  <?php $i++; ?>
		<?php } ?>
	  </div>
  </div>

  <div class="travel-footer">
	 <?php if(trim($data->travel_agent[0]->additional_logo!="")): ?>
	<?php $additionallogo=explode('|||',$data->travel_agent[0]->additional_logo);?>
	 <?php for($i=0;$i<=2;$i++): ?>
	<img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($additionallogo[$i]); ?>" alt="" title="" style="" />
     <?php endfor; ?>
	<?php endif; ?>
	<?php if(trim($data->travel_agent[0]->footer_sign)!=""): ?>
	<img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->travel_agent[0]->footer_sign); ?>" alt="" title="" style="clear:left;margin-top:15px;width:100%;" />
	<?php endif; ?>
  </div>
</div>

<span class="page-number"></span>