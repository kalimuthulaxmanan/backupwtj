<!-- Section Start -->
<section class="">  
	<div class="row center">  
		<div class="table-content pt-150">
			<div class="table-header">
				<p>  
				Distinguished guests  :   <?php echo e($data->distinguished_guests); ?> <br>
				Agency  :   <?php echo e($data->agency); ?><br>
				Agent  :   <?php echo e($data->agent); ?>

				</p>
				<h5>
				Duration  :   <?php echo e($data->duration_day); ?> days / <?php echo e($data->duration_night); ?> nights<br>
				Number of Persons  :   <?php echo e($data->no_of_persons); ?>

				</h5>
			</div>
			<div class="table-body">
				<h3>Summary</h3>
				<table>
					<?php $i=0; ?>
					<?php foreach($data1 as $pages): ?>
						<?php if($pages->show_summery == 1): ?>
					      <?php if($i < 10){ ?> 
						<tr>
						<td><?php echo e($pages->title); ?></td>
						<td style="text-align: left; width: 60px;">page <?php
						$num = $pages->content_order+session('pageadd');
						$num_padded = sprintf("%02d", $num);
						echo $num_padded;
						?></td>
						</tr>
					      <?php $i++; } ?>
					<?php endif; ?>
					<?php endforeach; ?>
					

					<!--<tr>
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
					</tr>-->
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
						<p class="bold" style="font-size: 15px;">Date of release  :   <?php $dates="$data->date_of_release";$date=date_create_from_format("Y-m-d","$dates");echo date_format($date,"F d, Y"); ?></p>
					</div>                      
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 footer-height text-right">
					<img class="footer-image right" src="<?php echo e(url('/')); ?>/<?php echo e($data->upload_path); ?>/<?php echo trim($data->signature); ?>" alt="" title="" style="width:200px;"/>
				</div>
			</div>               
		</div>          		
	  </div>          		
	</footer>      
</section> 
<!-- Section End -->