<div class=summerySection>	
<table style="margin-top:150px; width:100%;">
<tr style="">
<td colspan="2" style="text-align:center; font-size: 13px !important;">
<p>Distinguished guests:{{$data->distinguished_guests}}</p>
<p>Agency:{{$data->agency}}</p>
<p>Agent: {{$data->agent}}</p>

<p style="font-size: 15px !important;font-weight: 600 !important;">Duration: {{$data->duration_day}} day / {{$data->duration_night}} nights</p>
<p style="font-size: 15px !important;font-weight: 600 !important;">Number of Persons:{{$data->no_of_persons}}</p>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:center">
<p style="font-size: 30px;font-weight: 500 !important;letter-spacing: 1px;color: #000">Summary</p>
</td>
</tr>

@foreach($data1 as $pages)
@if ($pages->show_summery === 1)	
<tr>
<td>
<p>{{ $pages->title }}</p>
</td>
<td>
<p>Page {{ $pages->content_order+2 }}</p>
</td>
</tr>
@endif
@endforeach	

</table>
	
<p>&nbsp;</p>
<p>&nbsp;</p>



	
<table id='hrdftrtbl' border='0' cellspacing='0' cellpadding='0'>
    <tr>
    <td width="100%">
    <div style='mso-element:footer' id='f1'><span style='position:relative;z-index:-1'> 
       <table width="100%">
	   <tr>
	   <td align="left" class="footer" width="300">
	   <p>Date of release:<?php $dates="$data->date_of_release";$date=date_create_from_format("Y-m-d","$dates");echo date_format($date,"M d, Y"); ?></p></td>
	   <td align="right" width="380"><img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" width="150" height="50" /></td>
 </tr>
</table>
        <span style='mso-no-proof:yes'></span></span>
           <p class='MsoFooter'>
           <span style='mso-tab-count:2'></span>
        </p>
    </div>

        <div style='mso-element:footer' id='ff1'>
        <p class= 'MsoFooter'></p>
    </div>

    </td></tr>
    </table>	
			
</div>	
<br clear=all style='page-break-before:always;
mso-break-type:section-break'>