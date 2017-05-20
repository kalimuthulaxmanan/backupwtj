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
				<p>  
				Distinguished guests:{{$data->distinguished_guests}} <br>
				Agency:{{$data->agency}}<br>
				Agent: {{$data->agent}}
				</p>
				<h5>
				Duration: {{$data->duration_day}} day / {{$data->duration_night}} nights<br>
				Number of Persons:{{$data->no_of_persons}}
				</h5>
			</div>
			<div class="table-body">
				<h3>Summary</h3>
				<table class="text-left" style="width: 100%">
					
						@foreach($data1 as $pages)
					    
					  	@if ($pages->show_summery === 1)
					
						<tr>
						<td><a href="#">{{ $pages->title }}</a></td>
						<td>Page <?php
						$num = $pages->content_order+2;
						$num_padded = sprintf("%02d", $num);
						echo $num_padded;
						?></td>
						</tr>
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