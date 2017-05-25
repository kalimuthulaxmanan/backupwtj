<div class=summerySection>	
<table style="margin-top:150px; width:100%;">
<tr style="">
<td colspan="2" style="text-align:center; font-size: 13px !important;">
<p>Distinguished guests:<?php echo e($data->distinguished_guests); ?></p>
<p>Agency:<?php echo e($data->agency); ?></p>
<p>Agent: <?php echo e($data->agent); ?></p>

<p style="font-size: 15px !important;font-weight: 600 !important;">Duration: <?php echo e($data->duration_day); ?> day / <?php echo e($data->duration_night); ?> nights</p>
<p style="font-size: 15px !important;font-weight: 600 !important;">Number of Persons:<?php echo e($data->no_of_persons); ?></p>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:center">
<p style="font-size: 30px;font-weight: 500 !important;letter-spacing: 1px;color: #000">Summary</p>
</td>
</tr>

<?php foreach($data1 as $pages): ?>
<?php if($pages->show_summery === 1): ?>	
<tr>
<td>
<p><?php echo e($pages->title); ?></p>
</td>
<td>
<p>Page <?php echo e($pages->content_order+2); ?></p>
</td>
</tr>
<?php endif; ?>
<?php endforeach; ?>	

</table>
	
<p>&nbsp;</p>
<p>&nbsp;</p>


	
		
<div style='mso-element:footer' id="f1">
<p class="MsoFooter">
<table width="719" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="footer" width="300">
<p>Date of release:<?php $dates="$data->date_of_release";$date=date_create_from_format("Y-m-d","$dates");echo date_format($date,"M d, Y"); ?></p></td>
	<td align="right" width="380"><img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" width="150" height="50" /></td>
 </tr>
</table>
</p>	
</div>	
</div>	
<br clear=all style='page-break-before:always;
mso-break-type:section-break'>