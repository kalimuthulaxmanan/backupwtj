<!-- Section Start -->
<style>
.bold p{
    text-align: justify;
}
.bold p b{
    font-weight: 600 !important;
    color:#000;
}
</style>
    <table style="width:100%;">
		<tr style="">
            <td style="width:30%;"> 
            </td>
            <td style="width:70%; padding-right:15px;" class="bold">
				<h1 style="font-size: 30px;margin-top:0;margin-bottom:15px; padding-top:10px;color:#000;">{{$data->title}}</h1>
				<p>{!!nl2br($data->content)!!}</p>
            </td>
		</tr>
    </table>
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;">
                <img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" style="width:150px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>
	