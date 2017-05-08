<!-- Section Start -->
    <div style="width: 100%;">
		@foreach($data->frontImages as $frontImage)
		<img src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo trim($frontImage->image); ?>" alt="" title="" style="width: 100%;" />
	@endforeach	
    </div>
    <table style="height:120px;position:absolute;bottom:30px;">
		<tr style="">
            <td style="width:50%;vertical-align:bottom">
                <img src="<?php echo url($data->upload_path); ?>/<?php echo trim($data->logo); ?>" alt="" title="" style="width:200px;height:50px;" />
            </td>
            <td style="width:50%;text-align:right">
                <h1 style="font-size: 70px;margin:0;"><?php echo $data->place; ?></h1>
                <span><?php echo $data->start_date;?>/ <?php echo $data->end_date;?></span>
            </td>
		</tr>
    </table>
    <!-- Section End -->

	
<div style="page-break-after: always;"></div>