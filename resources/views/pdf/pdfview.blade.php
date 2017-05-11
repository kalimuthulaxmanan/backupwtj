
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300" rel="stylesheet">    
    <style>
	*{
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-weight: normal !important;
		color: #6d6e71;
		font-size:12px;
		padding: 0;
		margin: 0;
		
    }
		h1{
		font-family: 'Quicksand';
		}
	@page {
      size: 9in 9in;  /* width height */
   }	
	span{
		text-align:justify;
	}
	table{
		width:100%;
		padding: 0 15px;
	}
	table.padd-0{
		padding: 0;
	}
	table.padd-left{
		padding: 0;
		padding-left: 15px;
		margin: -2px -2px 0 0;
	}
	span.padd-left{
		display:block;
		padding-left:15px;
	}
	.summary-left td:first-child{
		padding-left: 250px;width:50%;
	}
	.summary-left td:last-child{
		padding-left: 100px;width:50%;
	}
	.map-image img{
		width: 100%;
		height: 100%;
		position: absolute;
	}
	</style>
<?php echo $data; ?>