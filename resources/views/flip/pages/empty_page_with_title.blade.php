
<div class="title-page" style="background-color:<?php echo $data->empty_page_color; ?> !important;">
	<h1>{{$data->title}}</h1> 
	<img src="{{ url('/') }}/{{$data->upload_path}}/<?php echo trim($data->logo); ?>" alt="" title="" />
</div>
<span class="page-number">{{$data->page}}</span>