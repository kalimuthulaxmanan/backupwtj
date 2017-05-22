<div class=contentSection>	
<table width=719 height=670>
<tr>
<td width=180>
	
</td>
<td width=539>
<p><span style="font-size: 30px;margin-top:0; padding-top:10px;">{{$data->title}}</span></p>
<p style="font-size: 13px">{!!nl2br($data->content)!!}</p>
</td>
</tr>
</table>
</div>	
  <div style='mso-element:footer' id="cf1">
<p class="MsoFooter">
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td class="footer" style="width:50%;">
                <img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($data->logo); ?>" alt="" title="" width="150" height="50" />
            </td>
		</tr>
    </table>
</p>	
</div>	
	
<br clear=all style='page-break-before:always;
mso-break-type:section-break' />
	