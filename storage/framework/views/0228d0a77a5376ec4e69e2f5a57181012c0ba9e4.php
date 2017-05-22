<!-- Section Start -->
<style type="text/css">
	.itinerary-image img{
		width: 100%;
		height: 144px;
	}
	.itinerary tr:first-child td{
		font-weight: 600;
	}
	.itinerary tr:last-child td{
		font-weight: 600;
	}
</style>
<section class="">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-8 col-sm-8 col-xs-12">
				<h1 class="left-title"><?php echo e($data->title); ?></h1>
				<table>					
					<tbody class="itinerary">
					<?php foreach($data->itineraryData as $itineraryValue): ?>
					  <tr>
						<td style="width:75px;vertical-align:top;line-height:20px;"><?php $dates="$itineraryValue->event_date";$date=date_create_from_format("Y-m-d","$dates");
								echo date_format($date,"F d"); ?>: </td>
					 	<td style="padding-bottom:15px;font-size:14px;vertical-align:top;line-height:20px;"><?php echo nl2br($itineraryValue->description); ?></td>
					  </tr>
					<?php endforeach; ?>
					<tbody>	
				</table>			
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 padd-0">
				<?php foreach($data->itineraryImages as $itineraryImage): ?>
				<div class="itinerary-image change-image" style="margin-right:0px;">
					<img  src="<?php echo e(url('/')); ?>/<?php echo trim($itineraryImage->image); ?>" id ="image<?php echo e($itineraryImage->id); ?>" alt="" title="" />
					<div class="img-overlay">
						<a onclick="newFunction('image<?php echo e($itineraryImage->id); ?>',<?php echo e($itineraryImage->id); ?>)" data-toggle="modal" data-target="#myModal" href="">Change Image</a>
					</div>
				</div>
				<?php endforeach; ?>
				
			</div>
		</div>               
	</div>    
	<footer class="pdf">    
	  <div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
					<img class="footer-image" src="<?php echo e(url('/')); ?>/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
				</div>
				<!-- <div class="col-md-9 col-sm-9 col-xs-12 footer-height text-right">
					<div class="footer-content">
						<h1>FRANCE</h1>
						<h3>April 08 2017</h3>
					</div>                        
				</div> -->
			</div>                
		</div>          		
	  </div>          		
	</footer>      
</section> 
<!-- Section End -->