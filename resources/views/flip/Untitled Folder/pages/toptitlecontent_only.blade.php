
<div class="book-content right-page">
	
	<div class="right-content">
		<h1>{{$data->title}}</h1>
		<p>{!!nl2br($data->content)!!}</p> 
	</div>	
</div>

<div class="footer right-page">
	<img src="{{ url('/') }}/<?php echo $data->upload_path; ?><?php echo $data->logo; ?>" alt="" title="" />
</div>
<span class="page-number">{{$data->page}}</span>