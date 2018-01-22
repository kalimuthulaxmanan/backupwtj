<!-- Section Start -->
    <table style="width:100%;padding-top: 175px;">
		<?php foreach($data->travel_agent as $travelagent) { ?>
		<tr style="">
            <td style="width:15%;padding-left: 15px;">
                <img src="<?php echo url($data->upload_path);?>/<?php echo trim($travelagent->profile_image); ?>" alt="" title="" />
            </td>
            <td style="width:70%; padding-top: 15px;">
				<p style="font-size:12px; margin:5px 0 !important;font-weight: 800 !important; color:#000;">YOUR TRAVEL AGENT IN <?php echo $travelagent->place; ?></p>
				<?php echo nl2br($travelagent->name); ?>
            </td>
		</tr>
		<?php } ?>
            <div class="travel-footer" style="position: absolute;text-align: center; width: 100%; bottom: 10px; padding: 0 15px;">
                <?php if(trim($data->travel_agent[0]->additional_logo!="")): ?>
                    <?php $additionallogo=explode('|||',$data->travel_agent[0]->additional_logo);?>
                    <?php for($i=0;$i<=2;$i++): ?>
                        <img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($additionallogo[$i]); ?>" alt="" title="" style="width:150px;height:50px;" />
                    <?php endfor; ?>
                <?php endif; ?>
                <?php if(trim($data->travel_agent[0]->footer_sign)!=""): ?>
                    <img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->travel_agent[0]->footer_sign); ?>" alt="" title="" style="clear:left;margin-top:15px;width:100%;height:50px;" />
                <?php endif; ?>
            </div>
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
