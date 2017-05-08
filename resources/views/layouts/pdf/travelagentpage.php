<!-- Section Start -->
    <table style="width:100%;padding-top: 200px;">
		<?php foreach($data->travel_agent as $travelagent) { ?>
		<tr style="">
            <td style="width:15%">
                <img src="<?php echo url($data->upload_path);?>/<?php echo trim($travelagent->profile_image); ?>" alt="" title="" />
            </td>
            <td style="width:70%;">
				<p><h1 style="margin:5px 0 !important;">YOUR TRAVEL AGENT IN <?php echo $travelagent->place; ?></h1>
				<?php echo $travelagent->name; ?><br />
				
				<img src="<?php echo url($data->upload_path);?>/<?php echo trim($travelagent->logo); ?>" alt="" title="" />	<br /><br />			
            </td>
		</tr>
		<?php } ?>
		
		<!--<tr style="">
            <td style="width:15%">
                <img src="images/image20.jpg" alt="" title="" />
            </td>
            <td style="width:70%;">
				<p><h1 style="margin:5px 0 !important;">YOUR TRAVEL AGENT IN BOSTON</h1>
				Ralp Decouvertes<br />
				Découvertes<br />
				<img src="images/image21.jpg" style="height: 35px;width: 180px;padding-top:5px;" alt="" title="" />			
            </td>
		</tr>-->
    </table>
    <!-- Section End -->

	<div style="page-break-after: always;"></div>
