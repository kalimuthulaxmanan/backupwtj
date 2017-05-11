<!-- Section Start -->
<section class="">  
	<div class="row center">  
		<div class="table-content pt-150">
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
				<table>
					<tr>
					<td>Welcome in France</td>
					<td>page 04</td>
					</tr>
					<tr>
					<td>Your itinerary</td>
					<td>page 06</td>
					</tr>
					<tr>
					<td>Champagne</td>
					<td>page 10</td>
					</tr>
					<tr>
					<td>Paris</td>
					<td>page 12</td>
					</tr>
					<tr>
					<td>Detailed itinerary</td>
					<td>page 18</td>
					</tr>
					<tr>
					<td>Sales and terms conditions</td>
					<td>page 19</td>
					</tr>
				</table>
			</div>
		</div>
	</div>  
	<footer class="pdf">    
	  <div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 col-sm-6 col-xs-12 footer-height">
					<div class="footer-content left">
						<p class="bold">Date of release:<?php $dates="$data->date_of_release";$date=date_create_from_format("Y-m-d","$dates");echo date_format($date,"M d, Y"); ?></p>
					</div>                      
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 footer-height text-right">
					<img class="footer-image right" src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" />
				</div>
			</div>               
		</div>          		
	  </div>          		
	</footer>      
</section> 
<!-- Section End -->