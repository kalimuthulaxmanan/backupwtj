<!-- Section Start -->	
<div class=itinerarySection>
    <table width=100% height=80%>
		<tr style="">
            <td width=470 style="vertical-align: top;padding-left:15px;">
				<h1 style="font-size: 50px;"><?php echo e($data->title); ?></h1> <br />
				<table  class="itinerary">
					<?php foreach($data->itineraryData as $itineraryValue): ?>
					<tr>
						<td style="width:80;padding-bottom:10px;vertical-align:top;line-height:20px;">
							<span><b><?php $dates="$itineraryValue->event_date";$date=date_create_from_format("Y-m-d","$dates");
							echo date_format($date,"M d"); ?>:</b></span><br />
						</td>
						<td style="width:250;padding-bottom:10px;vertical-align:top;line-height:20px;">
							<span><b><?php echo e($itineraryValue->description); ?></b></span><br/>
						</td><br /><br />
					</tr>
					<?php endforeach; ?>	
				</table>
            </td>
            <td width=249 style="text-align:right;">
				<?php foreach($data->itineraryImages as $itineraryImage): ?>
                <img src="<?php echo e(url('/')); ?>/<?php echo trim($itineraryImage->image); ?>" alt="" title="" width="220" height="130"  /><br />
				<?php endforeach; ?>  
            </td>
		</tr>		
    </table>
</div>	
<div style='mso-element:footer' id="itf1">
<p class="MsoFooter">
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td class="footer" style="width:50%;">
                <img src="<?php echo e(url('/')); ?>/<?php echo e($data->upload_path); ?>/<?php echo trim($data->logo); ?>" alt="" title="" width="150" height="50" />
            </td>
		</tr>
    </table>
</p>	
</div>	
    <!-- Section End -->	

	
	

	

<br clear=all style='page-break-before:always;
mso-break-type:section-break' />