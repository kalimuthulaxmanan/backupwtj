<!-- Section Start -->
    <table style="width:100%;height:100%;position:absolute;background-color:<?php echo $data->empty_page_color; ?>;">
		<tr style="">
            <td style="text-align:right">
				<h1 style="font-size: 100px;color:#fff">{{$data->title}}</h1>  
            </td>
		</tr>
    </table>
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;text-align:right">
                <img src="{{url('/')}}/{{$data->upload_path}}/<?php echo trim($data->signature); ?>" alt="" title="" style="width:200px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>