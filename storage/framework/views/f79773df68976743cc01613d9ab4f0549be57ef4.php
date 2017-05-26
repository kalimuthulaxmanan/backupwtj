 <div class=FrontpageSection>
		<?php foreach($data->frontImages as $frontImage): ?>
		<img width=720 height=500 src="<?php echo e(url('/')); ?>/<?php echo trim($frontImage->image); ?>"  />
	<?php endforeach; ?>
	 
	 
	 
<table id='hrdftrtbl' border='0' cellspacing='0' cellpadding='0'>
    <tr>
    <td width="100%">
    <div style='mso-element:footer' id='frf1'><span style='position:relative;z-index:-1'> 
       <table width="100%">
	   <tr>
	   <td align="left" class="footer" width="50%"><img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" width="150" height="50" /></td>
	   <td align="right" width="50%">
	   <h1><?php echo $data->place; ?></h1>
	   <p><?php  $dates="$data->start_date"; $date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"M d, Y");?> - <?php $datesend="$data->end_date"; $date=date_create_from_format("Y-m-d","$datesend");echo date_format($date,"M d, Y");?></p></td>
	   
 </tr>
</table>
        <span style='mso-no-proof:yes'></span></span>
           <p class= 'MsoFooter' >
           <span style='mso-tab-count:2'></span>
        </p>
    </div>

        <div style='mso-element:footer' id='ffrf1'>
        <p class=MsoFooter></p>
    </div>

    </td></tr>
    </table>	 
	 
	 	
    <!-- front page Section End -->
</div>	
	 
<br clear=all style='page-break-before:always;mso-break-type:section-break'>