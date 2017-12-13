<style>
.text-center{
	text-align:center;
}
.text-left{
	text-align:left;
}
</style>

<div class="table-contents text-center">  
	<div class="table-header">
		<p style="font-size:12px">  
		Distinguished guests:{{$data->distinguished_guests}} <br>
		Agency:{{$data->agency}}<br>
		Agent: {{$data->agent}}
		</p>
		<h5 style="font-weight:500;color:#555;font-size:14px;">
		Duration: {{$data->duration_day}} day / {{$data->duration_night}} nights<br>
		Number of Persons:{{$data->no_of_persons}}
		</h5>
	</div>
	<div class="table-body">
		<h3 style="font-size:24px;font-weight:500;">Summary</h3>
		<table class="text-left" style="width: 100%">
				<?php $i=0; ?>
				@foreach($data1 as $pages)

				@if ($pages->show_summery == 1)
				<?php if($i < 9){ ?> 
				<tr>
				<td><a href="#" style="color:#757575;background:none;">{!!  mb_substr($pages->title, 0,23)   !!}</a></td>
				<td>Page <?php
				$num = $pages->content_order+session('pageadd');
				$num_padded = sprintf("%02d", $num);
				echo $num_padded;
				?></td>
				</tr>
				<?php $i++; } ?>
			@endif
			@endforeach
		</table>
	</div>
</div>
<div class="index-footer summary-footer">
	<div class="left">
		<p class="bold" style="padding-left: 30px;">Date of release: <?php $dates="$data->date_of_release";$date=date_create_from_format("Y-m-d","$dates");echo date_format($date,"F d, Y"); ?></p>
	</div>
	<div class="right">
		<img class="footer-image right" src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" />
	</div>
</div>  
<span class="page-number">{{$data->page}}</span>