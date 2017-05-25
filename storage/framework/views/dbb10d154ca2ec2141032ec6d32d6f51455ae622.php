<!-- Section Start -->
<style>
.bold span b{
    font-weight: 600 !important;
}
</style>
    <table style="width:100%;padding-top:15px;">
		<tr style="">
            <td style="width:30%;vertical-align:top;">
				<h1 style="font-size: 25px;margin-top:0;padding-left:15px; line-height:20px;"><?php echo e($data->title); ?></h1>   
            </td>
            <td style="width:70%;padding-top:10px;" class="bold">
				<span><?php echo nl2br($data->content); ?></span><br /><br />
			
            </td>
		</tr>
    </table>
    <table style="height:50px;position:absolute;bottom:15px">
		<tr style="">
            <td style="width:50%;">
                <img src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" style="width:150px;height:50px;" />
            </td>
		</tr>
    </table>
    <!-- Section End -->
	
	
	<div style="page-break-after: always;"></div>