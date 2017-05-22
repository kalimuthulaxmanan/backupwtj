 <div class=FrontpageSection>
		<?php foreach($data->frontImages as $frontImage): ?>
		<img width=720 height=500 src="<?php echo e(url('/')); ?>/<?php echo trim($frontImage->image); ?>"  />
	<?php endforeach; ?>
	 
<div style='mso-element:footer' id="fr1">
<p class="MsoFooter">    
    <table width=100% style="height:120px;position:absolute;bottom:30px;">
		<tr style="">
            <td width=20% style="vertical-align:bottom">
                <img src="<?php echo url($data->upload_path); ?>/<?php echo trim($data->logo); ?>" alt="" title="" width="150" height="50" />
            </td>
            <td width=50% style="width:50%;text-align:right; padding-right: 25px;">
                <h1 style="font-size:30px;text-transform:capitalize;line-height:70px;margin-bottom:-10px;margin-top:10px;">France</h1>
                <p style="font-size:28px;margin:0;"><?php  $dates="$data->start_date"; $date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"M d");?> - <?php $datesend="$data->end_date"; $date=date_create_from_format("Y-m-d","$datesend");echo date_format($date,"M d Y");?></p>
            </td>
		</tr>
    </table>
</p>	
</div>	
    <!-- front page Section End -->
</div>	
	 
<br clear=all style='page-break-before:always;mso-break-type:section-break'>