<div class=detailitinerarysection>
<table width=100%>
		<tr style="">
            <td style="width:60%;vertical-align: top;padding-left:15px;">
				<h1 style="font-size: 30px;color:#000;"><?php echo e($data->title); ?></h1> <br />
				<table>
					<?php foreach($data->detailitineraryDatas as $detail_itineraryData): ?>
					<tr>
						<td height=8>
						<b style="font-weight:600;color:#444;"><?php $dates="$detail_itineraryData->event_date"; $date=date_create_from_format("Y-m-d","$dates");
						echo date_format($date,"M d");?></b>
						</td>
					</tr>
					<tr>	
						<td style="padding-left:20px;padding-top:10px;line-height:20px">
	                         <?php echo nl2br($detail_itineraryData->description); ?><br />
						</td>
					</tr>
					<?php endforeach; ?>	
				</table>
            </td>
            <td style="width:40%;text-align:right">
				<?php foreach($data->detailitineraryImages as $detailitineraryImage): ?>
                <img src="<?php echo e(url('/')); ?>/<?php echo trim($detailitineraryImage->image); ?>" alt="" title="" width="220" height="130" /><br />
				<?php endforeach; ?>

			
                
            </td>
		</tr>
    </table>
  <div style='mso-element:footer' id="dtf1">
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
	
<br clear=all style='page-break-before:always;
mso-break-type:section-break' />