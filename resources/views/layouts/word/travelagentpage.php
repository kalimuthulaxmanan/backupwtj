<div class=travelagentsection>	
	
   <table style="width:100%;padding-top: 175px;">
		<tr style="">
            <td style="width:15%;padding-left: 15px;">
				<?php foreach($data->travel_agent as $travelagent) { ?>
                <img src="<?php echo url($data->upload_path);?>/<?php echo trim($travelagent->profile_image); ?>" alt="" title="" /><br /> <br />
			    <?php } ?>	
            </td>
            <td style="width:70%; padding-top: 15px;">
				<?php foreach($data->travel_agent as $travelagent) { ?>
				<p style="font-size:12px; margin:5px 0 !important;font-weight: 800 !important;">YOUR TRAVEL AGENT IN <?php echo $travelagent->place; ?></p>
				  <?php echo nl2br($travelagent->name); ?><br />
				
				<img src="<?php echo url($data->upload_path);?>/<?php echo trim($travelagent->logo); ?>" alt="" title="" height=28 width=115 padding-top=10px />	<br /><br />			
				
            <?php } ?>
			</td>
		</tr>
		
    </table>	
</div>	
<div style='mso-element:footer' id="taf1">
<p class="MsoFooter">
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td class="footer" style="width:50%;">
              
            </td>
		</tr>
    </table>
</p>	
</div>

	



<br clear=all style='page-break-before:always;
mso-break-type:section-break' />