<!-- Section Start -->
<style type="text/css">
	.index-image img{
		width: 100%;
		height: 500px;
	}
</style>
    <div style="width: 100%;" class="index-image">
		@foreach($data->frontImages as $frontImage)
		<img src="{{ url('/') }}/<?php echo trim($frontImage->image); ?>" alt="" title="" style="width: 100%;" />
	@endforeach	
    </div>
    <table style="height:120px;position:absolute;bottom:30px;">
		<tr style="">
            <td style="width:50%;vertical-align:bottom">
                <img src="<?php echo url($data->upload_path); ?>/<?php echo trim($data->logo); ?>" alt="" title="" style="width:200px;height:50px;" />
            </td>
            <td style="width:50%;text-align:right">
                <h1 style="font-size:100px;text-transform:capitalize;line-height:70px;margin-bottom:-10px;margin-top:10px;"><?php echo $data->place; ?></h1>
                <span style="font-size:28px;margin:0;"><?php  $dates="$data->start_date"; $date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"M d");?> - <?php $datesend="$data->end_date"; $date=date_create_from_format("Y-m-d","$datesend");echo date_format($date,"M d Y");?></span>
            </td>
		</tr>
    </table>
    <!-- Section End -->

	
<div style="page-break-after: always;"></div>