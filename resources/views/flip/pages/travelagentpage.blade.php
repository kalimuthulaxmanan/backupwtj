
<div class="book-content right-page" style="display:flex;align-items:center;height:100%;">
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
			<p>{!!nl2br($travelagent->name)!!}<br/></p>
		</div>
	</div>
	  <?php }?>
	  <?php $i++; ?>
	<?php } ?>
  </div>
</div>

<span class="page-number">{{$data->page}}</span>