
<div class="title-page" style="background-color:<?php echo $data->empty_page_color; ?> !important;">
	<h1>{{$data->title}}</h1> 
	<img src="{{url('/')}}/<?php echo $data->upload_path; ?><?php echo trim($data->signature); ?>" alt="" title="" class="index-footer" />
</div>
<span class="page-number">{{$data->page}}</span>