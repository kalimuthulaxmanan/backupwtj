<div class=emptypagecolorSection>
<table  style="width:100%;height:600;position:absolute;background-color:<?php echo $data->empty_page_color; ?>;">
		<tr style="">
            <td style="text-align:right; padding-right:20px">
				<h1 style="font-size:65px;color:#fff"><?php echo e($data->title); ?></h1>  
            </td>
		</tr>

</table>
	
<table id='hrdftrtbl' border='0' cellspacing='0' cellpadding='0'  >
    <tr>
    <td>
    <div style='mso-element:footer' id=epcf1><span style='position:relative;z-index:-1'> 
       <img src="<?php echo e(url('/')); ?>/<?php echo e($data->upload_path); ?>/<?php echo trim($data->signature); ?>" alt="" title="" width="150" height="50" />
        <span style='mso-no-proof:yes'></span></span>
           <p class= 'MsoFooter'>
           <span style= 'mso-tab-count:2'></span>
        </p>
    </div>
        <div style='mso-element:footer' id='fepcf1'>
        <p class='MsoFooter'></p>
    </div>

    </td></tr>
    </table>	

</div>	
	<br clear=all style='page-break-before:always;
mso-break-type:section-break' />