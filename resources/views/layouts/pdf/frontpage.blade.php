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
        <img src="{{ url('/') }}/{{$data->upload_path}}/<?php echo trim($data->signature); ?>" alt="" title="" style="width:150px;height:50px;position:absolute;top:440px;left:10px;" />
	@endforeach
    </div>
    <table style="height:120px;position:absolute;bottom:20px;">
		<tr style="">
            <td style="width:50%;vertical-align:bottom">
                @if(trim($data->additional_logo)!="")
                    <img src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo trim($data->additional_logo); ?>" alt="" title="" style="width:150px;height:50px;margin-bottom:15px;"/>
                @endif
                <img src="<?php echo url($data->upload_path); ?>/<?php echo trim($data->logo); ?>" alt="" title="" style="clear:both;width:150px;height:50px;" />
            </td>
            <td style="width:50%;text-align:right; padding-right: 20px;">
                <h1 style="font-size:100px;text-transform:capitalize;line-height:70px;margin-bottom:-10px;margin-top:10px;"><?php echo $data->country; ?></h1>
                <span style="font-size:22px;margin:0;"><?php  $dates="$data->start_date"; $date=date_create_from_format("Y-m-d","$dates");
echo date_format($date,"M d, Y");?> - <?php $datesend="$data->end_date"; $date=date_create_from_format("Y-m-d","$datesend");echo date_format($date,"M d, Y");?></span>
            </td>
		</tr>
    </table>
    <!-- Section End -->


<div style="page-break-after: always;"></div>