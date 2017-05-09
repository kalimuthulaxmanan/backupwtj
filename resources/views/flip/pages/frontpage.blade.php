
<div class="book-content index-page">
	@foreach($data->frontImages as $frontImage)
	<img src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo trim($frontImage->image); ?>" width="100%" alt="" title="" />
	@endforeach
</div>

<div class="index-footer">
	<div class="left">
		<img src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo trim($data->logo); ?>" alt="" title="" />
	</div>
	<div class="right">
		<h1><?php echo $data->place; ?></h1>
		<span><?php echo $data->start_date;?>/ <?php echo $data->end_date;?></span>
	</div>
</div>
<span class="page-number">{{$data->page}}</span>