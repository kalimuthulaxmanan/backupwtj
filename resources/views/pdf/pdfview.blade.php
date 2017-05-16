
    <!-- CSS -->   
    <style>
	*{
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-weight: normal !important;
		color: #6d6e71;
		font-size:12px;
		padding: 0;
		margin: 0;
		
    }
    @font-face{
		font-family: 'helvetica25';
		src: url(assets/fonts/helveticaneueltStd-ultLt25.ttf);
	}
	h1{
		font-family: 'helvetica25';
	}
	@page {
      size: 7.5in 7.5in;  /* width height */
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

	.itinerary tr:first-child td{
		font-weight: 600!important;
	}
	.itinerary tr:last-child td{
		font-weight: 600!important;
	}
	</style>
<?php echo $data; ?>