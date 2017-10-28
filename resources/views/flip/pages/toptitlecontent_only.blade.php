<div class="book-content right-page">
	<div class="left-image terms-conditions"> 
		<!-- <h5>{{$data->title}}</h5> -->
	</div>

	<div class="right-content">
		<h1>{{$data->title}}</h1>
		<?php $data->content=strip_tags($data->content, '<br><b><p><a>\n');    ?>
		<p>{!!nl2br($data->content)!!}</p> 
	</div>	
</div>

<div class="footer right-page">
	<img src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo $data->logo; ?>" alt="" title="" />
</div>
<span class="page-number">{{$data->page}}</span>