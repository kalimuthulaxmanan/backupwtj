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
				<table class="text-left">
						@foreach($data1 as $pages)
					
						@if ($pages->show_summery === 1)
					
						<tr>
						<td>{{ $pages->title }}</td>
						<td>Page {{ $pages->content_order+2 }}</td>
						</tr>
					@endif
					@endforeach
				</table>
			</div>
	<footer class="pdf">    
	  <div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 col-sm-6 col-xs-12 footer-height">
					<div class="footer-content left">
						<p class="bold">Date of release: <?php $dates="$data->date_of_release";$date=date_create_from_format("Y-m-d","$dates");echo date_format($date,"M d, Y"); ?></p>
					</div>                      
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 footer-height text-right">
					<img class="footer-image right" src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" />
				</div>
			</div>               
		</div>          		
	  </div>          		
	</footer>      
</div>
<span class="page-number">{{$data->page}}</span>