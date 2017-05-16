<!-- Section Start -->
<style>
.bold span b{
    font-weight: 600 !important;
}
</style>
    <table style="width:100%;padding-top:20px;">
		<tr style="">
            <td style="width:30%;vertical-align: top;">
				<h1 style="font-size: 24px;margin-top:0;">{{$data->title}}</h1>   
            </td>
            <td style="width:70%;" class="bold">
				<span>{!!nl2br($data->content)!!}</span><br /><br />
			
            </td>
		</tr>
    </table>
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;">
                <img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" style="width:200px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>