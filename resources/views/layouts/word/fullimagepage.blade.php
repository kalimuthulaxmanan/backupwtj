<div class=Section1>
@foreach($data->fullImages as $fullimage)
<img width=719 height=719
 src="{{ url('/') }}/<?php echo trim($fullimage->image); ?>"/>
@endforeach
</div>

<br clear=all style='page-break-before:always;
mso-break-type:section-break' />