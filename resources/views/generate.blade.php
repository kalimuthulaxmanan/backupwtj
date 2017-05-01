@extends('layouts.main')

@section('content1')
<div class="content pdf-view">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
                            <div class="card">
                               <!-- <div class="card-header" data-background-color="purple">
                                    <h4 class="title">File Table</h4>
                                    <p class="category">Details about the Files</p>
                                </div>-->
                                <div class="card-content table-responsive">
									
									<!-- PDF view start -->

									<a href=""> <button type="button"  class="btn btn-primary ">Word</button></a>
									<a href="{{ url('/download') }}" target="_blank"> <button type="button" class="btn btn-primary ">PDF</button></a>	
									<a href="" > <button type="button" class="btn btn-primary ">Flip Book</button></a>	

									<div class="container">

											<!-- Section Start -->
											<section class="">        
												<div class="fullwidthimage change-image">
													<img src="images/fileimage/images/image1.jpg" alt="" title="" />
													<div class="img-overlay">
														<a href="">Change Image</a>
													</div>
												</div>

												<footer class="pdf">    
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
															</div>
															<div class="col-md-9 col-sm-9 col-xs-12 footer-height text-right">
																<div class="footer-content">
																	<h1>France</h1>
																	<h3>April 08 2017</h3>
																</div>                        
															</div>
														</div>                
													</div>       		
												</footer>
											</section>	
											<!-- Section End -->

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12">
													</div>                
												</div>   
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
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

											<!-- Section Start -->
											<section class="">  
												<div class="row center">  
													<div class="table-content pt-150">
														<div class="table-header">
															<p>  
															Distinguished guests: Antonio Compton<br>
															Agency: American Express - Boston (HQ)<br>
															Agent: Cassandra Angus
															</p>
															<h5>
															Duration: 1 day / 0 nights<br>
															Number of Persons: 2
															</h5>
														</div>
														<div class="table-body">
															<h3>Summary</h3>
															<table>
																<tr>
																<td>Welcome in France</td>
																<td>page 04</td>
																</tr>
																<tr>
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
																</tr>
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
																	<p class="bold">Date of release: March 29,2017</p>
																</div>                      
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12 footer-height text-right">
																<img class="footer-image right" src="images/fileimage/images/image3.jpg" alt="" title="" />
															</div>
														</div>               
													</div>          		
												  </div>          		
												</footer>      
											</section> 
											<!-- Section End -->

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12">
														<div class="title">     
															<h1 class="big-title mt-25">Welcome to France!</h1>
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12">  
															<div class="change-image">
																<img src="images/fileimage/images/image4.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12">
															<p class="bold">
																France is as diverse as its landscapes: from the endless beaches of
																Normandy to the perched villages of Provence and the green hills of
																Auvergne to the turquoise bays of Corsica. Meet the real French for wine
																tastings and cooking classes, off-the-beaten-tracks visits, exclusive
																itineraries with our expert licensed guides that drive and more...
															</p><br />
															<p class="bold">
																Discover the largest country of West Europe, more of half of France is
																composed of vast plains, beautiful coasts and France hosts Western
																Europe's highest peak in the Alps, Mont Blanc. The climate is temperate,
																except near the mountains or in the northeast, with cool winters and mild
																summers. Southern France is generally warm, with mild winters and hot
																summers.
															</p>                
														</div>
													</div>                
												</div>
												<br />
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4 col-sm-4 col-xs-12">
															<div class="change-image">
																<img src="images/fileimage/images/image5.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12">						
															<p class="bold">
																French people are known for good fashion sense and good food. They
																are courteous people, but also frank and usually to the point. French is
																the official language of France, and it is important for you to learn a bit of
																French. Indeed, your trip will be more enjoyable if you are able to relate
																to French people. Also, it will be easier to understand the culture once
																you learn the language.
															</p><br />
															<p class="bold">
																As for French manners, the handshake is commonly used in France
																when people meet another for the first time, in both social and business
																settings. Close friends greet each other by kissing each other on the
																cheek (Ia bise). People typically greet one another with bonjour (good
																morning), bonsoir (good afternoon) and au revoir (goodbye). Party
																guests are expected to bring a gift, such as flowers or a bottle of wine.
															</p>                
														</div>
													</div>                
												</div>    
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
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

											<!-- Section Start -->
											<section class="">        
												<div class="fullwidthimage change-image">
													<img src="images/fileimage/images/image6.jpg" alt="" title="" />
													<div class="img-overlay">
														<a href="">Change Image</a>
													</div>
												</div>
											</section>	
											<!-- Section End -->

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-8 col-sm-8 col-xs-12">
														<h1 class="left-title">Your itinerary</h1> 
														<p><b>April 08: &nbsp;  &nbsp;  &nbsp; Arrival in Champagne And Paris</b></p><br />
														<p>April 08:  &nbsp;  &nbsp;  &nbsp; Luxury minivan with driver at disposal<br /><br />
															 &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp; Full day excursion with a guide in Champagne<br /><br />
															 &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp; Champagne Moet & Chandon</p> <br /> 
														<p><b>April 08: &nbsp;  &nbsp;  &nbsp; Departure Day</b></p>    
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12 padd-0">
															<div class="change-image" style="margin-right:-1px;">
																<img src="images/fileimage/images/image7.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
															<div class="change-image" style="margin-right:-1px;">
																<img src="images/fileimage/images/image8.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
															<div class="change-image" style="margin-right:-1px;">
																<img src="images/fileimage/images/image9.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
															<div class="change-image" style="margin-right:-1px;">
																<img src="images/fileimage/images/image10.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
														</div>
													</div>               
												</div>    
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
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

											<!-- Section Start -->
											<section class="">        
												<div class="fullwidthimage change-image">
													<div style="width: 720px; height: 720px;">
                                                  {!!$map!!}
                                                </div>
												</div>
											</section>	
											<!-- Section End -->

											<!-- Section Start -->
											<section class="title-page">  
												<!-- Section To Display Empty -->
											</section> 
											<!-- Section End -->


											<!-- Section Start -->
											<section class="title-page">  
												<div class="row"> 
													<div class="col-md-12">
														<div class="col-md-12 col-sm-12 col-xs-12 text-right">
															<div class="title title-padd">
																<h1 class="big-title">Champagne</h1> 
															</div>                        
														</div>
													</div> 
												</div>  
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-6 col-sm-6 col-xs-12 footer-height">
																<div class="footer-content left"></div>                      
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12 footer-height text-right">
																<img class="footer-image right" src="images/fileimage/images/image3.jpg" alt="" title="" />
															</div>
														</div>               
													</div>          		
												  </div>          		
												</footer>      
											</section> 
											<!-- Section End -->

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12">
														<div class="title">     
															<h1 class="left-title mt-25">Discover Champagne!</h1>
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12">  
															<div class="change-image">
																<img src="images/fileimage/images/image12.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12">
															<p class="bold">
																Champagne borders Ile-de-France in the south-west. Its name comes
																from the Romans who called it Campania, meaning literally "Land of the
																Plains". The rolling prairies that give the region its name are located in
																the south between Reims/Epernay and Troyes. Closer to the border with
																Belgium, the landscape becomes more rugged and deeply forested.
															</p><br />
															<p class="bold">
																Champagne, lying south to the east of the Paris region, is one of the
																great historic provinces of France. As far back as the times of the
																Emperor Charlemagne, in the ninth century, Champagne was one of the
																great regions of Europe, a rich agricultural area that was famous for its
																fairs. Today, thanks to a type of sparkling wine to which the region has
																given its name, the word Champagne is known worldwide – even if many
																of those who know the drink do not know exactly where it comes from.
															</p>                
														</div>
													</div>                
												</div>
												<br />
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4 col-sm-4 col-xs-12">
															<div class="change-image">
																<img src="images/fileimage/images/image13.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12">						
															<p class="bold">
																Champagne, that most delightful of sparkling wines, was not actually
																invented in the region. According to legend, it was monks who bought
																the method for making sparkling wine up from the Languedoc, in the
																south of France; but they soon discovered that the chalky soil and
																climatic conditions in the Champagne region produced a bright
																bubbly wine that was in many people's opinion better than the sparkling
																wines produced further south.
															</p><br />
															<p class="bold">
																The traditional French Northern cooking is based on the products of the
																soil - known as Cuisine du Terroir - and emphasizes the French Art de la
																Table. You could appreciate an andouillette de Troyes or the Rhetel
																recipe of boudin blanc, classics of the traditional family meals in the
																Champagne region. For the vegetables' lovers, the
																typical pot-au-feu-like La Joute is just as delightful. 
															</p>                
														</div>
													</div>                
												</div>    
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
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

											<!-- Section Start -->
											<section class="">        
												<div class="fullwidthimage change-image">
													<img src="images/fileimage/images/image14.jpg" alt="" title="" />
													<div class="img-overlay">
														<a href="">Change Image</a>
													</div>
												</div>
											</section>	
											<!-- Section End -->

											<!-- Section Start -->
											<section class="title-page">  
												<!-- Section To Display Empty -->
											</section> 
											<!-- Section End -->


											<!-- Section Start -->
											<section class="title-page">  
												<div class="row"> 
													<div class="col-md-12">
														<div class="col-md-12 col-sm-12 col-xs-12 text-right">
															<div class="title title-padd">
																<h1 class="big-title">Paris!</h1> 
															</div>                        
														</div>
													</div> 
												</div>  
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-6 col-sm-6 col-xs-12 footer-height">
																<div class="footer-content left"></div>                      
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12 footer-height text-right">
																<img class="footer-image right" src="images/fileimage/images/image3.jpg" alt="" title="" />
															</div>
														</div>               
													</div>          		
												  </div>          		
												</footer>      
											</section> 
											<!-- Section End -->

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12">
														<div class="title">     
															<h1 class="left-title mt-25">Discover Paris!</h1>
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12">  
															<div class="change-image">
																<img src="images/fileimage/images/image15.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12">
															<p class="bold">
																Like all the world's great capitals, Paris lives at a fast pace, by day and
																night. It is divided into 20 districts that spiral out like a snail shell from
																the first, centered round the Louvre. Enjoy a stroll through Paris while on
																vacation and soak up the "art de vivre", it will feel as if you are walking
																through an open-air museum. Admire the city's regal buildings, gardens,
																fountains and places which have witnessed so monumental events & so
																fascinating history.
															</p><br />
															<p class="bold">
																Paris is a place of iconic architecture, with its famous cloud-piercing
																Eiffel tower, Arc de Triomphe at the end of the most famous avenue of
																the world, les Champs-Elysees. Notre-Dame and its gargoyles, old
																bridges and Art Nouveau cafes are famously part of the City. Always
																evolving, the City now proudly shows the contemporary Centre
																Pompidou and the Musee du Quai Branly and its vegetal wall.
															</p>                
														</div>
													</div>                
												</div>
												<br />
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4 col-sm-4 col-xs-12">
															<div class="change-image">
																<img src="images/fileimage/images/image16.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12">						
															<p class="bold">
																Paris is also famous for its cuisine. Anywhere from cosy bistros to
																three-star Michelin stars, you'll be able to find quality produces, with
																excellent presentation and preparation, always served with wine. Stop at
																the cheese shops, boulangeries, patisseries for top produces to take to a
																picnic in the city's parks and gardens.
															</p><br />
															<p class="bold">
																Lastly, browse designer boutiques, flagship haute couture stores,
																concept stores to find the perfect dress. Wander in vintage shops and
																flea markets, original bookshops and bookseller on the banks of the
																Seine, antique dealers, gourmet food and wine shops galore! 
															</p>                
														</div>
													</div>                
												</div>    
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
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

											<!-- Section Start -->
											<section class="">        
												<div class="fullwidthimage change-image">
													<img src="images/fileimage/images/image17.jpg" alt="" title="" />
													<div class="img-overlay">
														<a href="">Change Image</a>
													</div>
												</div>
											</section>	
											<!-- Section End -->

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12">
														<div class="title">     
															<p class="mt-25"><b>APR 08, 2017</b> - YOUR MORNING VISIT IN CHAMPAGNE</p>
															<h1 class="left-title">Champagne Moet & Chandon</h1>
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12">  
															<div class="change-image">
																<img src="images/fileimage/images/image9.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div><br />
															<div class="change-image">
																<img src="images/fileimage/images/image10.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12">
															<p class="bold">
																Moët et Chandon began as Moët et Cie (Moët & Co.), established by
																Épernay wine trader Claude Moët in 1743, and began shipping his wine
																from Champagne to Paris. The reign of King Louis XV coincided with
																increased demand for sparkling wine. Soon after its foundation, and after
																son Claude-Louis joined Moët et Cie, the winery's clientele included
																nobles and aristocrats. Following the introduction of the concept of a
																vintage champagne in 1840, Moët marketed its first vintage in 1842.
																Their best-selling brand, Brut Imperial was introduced in the 1860s. Their
																best known label, Dom Perignon, is named for the Benedictine monk
																remembered in legend as the "Father of Champagne". Moët & Chandon
																merged with Hennessy Cognac in 1971 and with Louis Vuitton in 1987 to
																become LVMH (Louis-Vuitton-Moët-Hennessy), the largest luxury group
																in the world, netting over 16 billion euros in fiscal 2004. Moët & Chandon
																holds a Royal Warrant as supplier of champagne to Queen Elizabeth II.
																In 2006, Moët et Chandon Brut Impérial issued an extremely limited
																bottling of its champagne named "Be Fabulous", a special release of its
																original bottle with decorative Swarovski crystals, marking the elegance
																of Moët et Chandon.
															</p>                
														</div>
													</div>                
												</div>  
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
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

											<!-- Section Start -->
											<section class="">        
												<div class="fullwidthimage change-image">
													<img src="images/fileimage/images/image18.jpg" alt="" title="" />
													<div class="img-overlay">
														<a href="">Change Image</a>
													</div>
												</div>
											</section>	
											<!-- Section End -->

											<!-- Section Start -->
											<section class="title-page">  
												<!-- Section To Display Empty -->
											</section> 
											<!-- Section End -->

											<!-- Section Start -->
											<section class="title-page">  
												<div class="row"> 
													<div class="col-md-12">
														<div class="col-md-12 col-sm-12 col-xs-12 text-right">
															<div class="title title-padd">
																<h1 class="big-title">Services</h1> 
															</div>                        
														</div>
													</div> 
												</div>  
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-6 col-sm-6 col-xs-12 footer-height">
																<div class="footer-content left"></div>                      
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12 footer-height text-right">
																<img class="footer-image right" src="images/fileimage/images/image3.jpg" alt="" title="" />
															</div>
														</div>               
													</div>          		
												  </div>          		
												</footer>      
											</section> 
											<!-- Section End -->

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-8 col-sm-8 col-xs-12">
															<h1 class="left-title">Detailed itinerary</h1> 
															<p><b>April 08</b></p>
															<p class="lh-20">
																&nbsp; &nbsp; &nbsp; - &nbsp; 08:00 am : Luxury minivan with driver at disposal from Paris Orly<br />
																&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; airport to Shangri-La Hotel<br />

																&nbsp; &nbsp; &nbsp; - &nbsp; Full day excursion with a guide in Champagne<br />
																&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 11:00 am : pick up at Champagne Ployez-Jacquemart<br />
																&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 05:30 pm : drop off at End of tour<br />

																&nbsp; &nbsp; &nbsp; - &nbsp; Champagne Moet & Chandon<br />						 
															</p>    
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12 padd-0">
															<div class="change-image" style="margin-right:-1px;">
																<img src="images/fileimage/images/image8.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
															<div class="change-image" style="margin-right:-1px;">
																<img src="images/fileimage/images/image9.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
															<div class="change-image" style="margin-right:-1px;">
																<img src="images/fileimage/images/image10.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
															<div class="change-image" style="margin-right:-1px;">
																<img src="images/fileimage/images/image7.jpg" alt="" title="" />
																<div class="img-overlay">
																	<a href="">Change Image</a>
																</div>
															</div>
														</div>
													</div>               
												</div>    
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
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

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4 col-sm-4 col-xs-12">
															<h1 class="font-26">Sales and terms conditions</h1>     
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12 mt-25 sales-content">
															<p>Please note that our quotes are merely informative as all services are subject to
																availability. All fares and availabilities will therefore be confirmed on the day you
																confirm your client’s booking by faxing us back the signed credit card authorization
																form.</p>
															<h6>TOTAL COST INCLUDES THE FOLLOWING:</h6> 
															<p>The total NET price provided by Découvertes
																tailor-made itinerary, Découvertes’ fees and
																negotiated rates are confidential and therefore,
																does not provide a break-down of rates and
																understanding.</p>
															<h6>VIP TREATMENT</h6>
															<p class="pl-20">- Personalised Itinerary<br>
																- Prepaid Voucher/s<br>
																- Co-ordination and Support<br>
																- 24 hours Concierge service (Assistance) during your trip</p>
															<h6>TRIP COST DOES NOT INCLUDE:</h6> 
															<p class="pl-20">- Airfare not listed in the itinerary<br>
																- Transfers not specified in the itinerary<br>
																- Entrances fees when not mentioned<br>
																- Meals when not mentioned<br>
																- Room Service<br>
																- Excess Baggage Charges<br>
																- Porterage<br>
																- Passport and Visa Fees<br>
																- Personal & Travel Insurance<br>
																- Gratuities<br>
																- Any Item specified as ‘Own Arrangements’</p> 
														</div> 
													</div>               
												</div>    
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
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

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4 col-sm-4 col-xs-12">
															<h1 class="font-26"></h1>     
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12 mt-25 sales-content">
															<h1 class="font-42">Terms conditions</h1>
															<p><b>RESERVATIONS</b></p>
															<p><b>GUIDE- DRIVERS Vs DRIVER-GUIDES:</b></p>
															<p>Our Guide-drivers will chauffeur your clients; they are also licensed to guide
																and accompany them into museums and monuments.</p>
															<p>
																Driver-guides are NOT qualified to enter and guide your clients into museums, as
																well as around historical monuments and sights, for this purpose we recommend
																your clients have either a driver AND a guide or a Guide who is licensed and
																insured to drive. Our Driver-guides all speak very good English and will chauffeur
																your clients on sightseeing tours, their knowledge of the historical aspects of the
																territory can NOT be incompared to that of a guide.</p>
															<p> 
																A 30% deposit is requested at the time of booking and full payment 45 days prior
																to your clients' arrival in France, unless otherwise advised. Payment is made in
																Euros and can be made by credit card, US Dollars check, Euro check or wire
																transfer.<br />
																Découvertes accepts the following credit cards: American Express, Visa and
																Mastercard. Please note that Découvertes does not charge any supplement for
																credit card payments.
															</p>
															<p><b>FINAL DOCUMENTS</b></p>
															<p>You will receive, via email, 30 days prior to the travelers arrival in France the
																following documentation: General Prepaid Voucher, Individual Vouchers for hotels
																and special services where required.</p>
														</div> 
													</div>               
												</div>    
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
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

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4 col-sm-4 col-xs-12">
															<h1 class="font-26"></h1>     
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12 mt-25 sales-content">
															<h1 class="font-42">Cancellation policy</h1>
															<p>Découvertes
																strongly
																recommends
																that
																travellers
																purchase
																trip
																cancellation/interruption insurance. The following cancellation penalties apply for
																non group bookings:-</p>
															<p>- In case of cancellation up to 30 days of individual services (up to 7 services)
																– a penalty of Euro 35,00 per service will be charged.<br>
																- In case of cancellation up to 30 days before arrival of more than 7 services -
																an administration fee of 250 Euros per person will be charged;<br>
																- In case of cancellation up to 30 - 15 days prior to arrival date 25% of the full
																cost of your holiday will be charged.<br>
																- In case of cancellation 14 - 7 days before - 50% of the full cost of your
																holiday will be charged.<br>
																- In case of cancellation less than 7 days prior to arrival date - 100% of the full
																cost of your holiday will be charged.</p>
															<p><b>Refunds</b></p>
															<p>Within 30 days of receiving written notification of the cancellation the refund will be
																processed. The refund will be made in Euro or US Dollars and sent to the
																traveller, via the travel consultant by Check.</p>
															<p><b>UNFORSEEN CIRCUMSTANCES</b></p>
															<p>Trip costs do not include items not specified in the itinerary. Although Découvertes
																will make every effort to adhere to this itinerary, on rare occasions it may be
																necessary to make an adjustment to these arrangements. Should such adjustment
																be necessary, a substitute will be offered when and where possible. If war or
																terrorist activities threatened or actual, civil unrest, closures of airports or
																seaports, industrial action threatened or any other event outside the control of
																Découvertes which causes either delays or extends the holiday or compels a
																change in the holiday arrangements.</p>
															<p>Découvertes cannot accept liability for any resulting loss, damage or expense and
																any refund will be subject to deduction of reasonable expenses. These conditions
																are governed by French law and both parties shall submit to the jurisdiction of
																French Courts at all times.</p>
														</div> 
													</div>               
												</div>    
												<footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image2.jpg" alt="" title="" />
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

											<!-- Section Start -->
											<section class="empty-page">  
												<!-- Section To Display Empty -->
											</section> 
											<!-- Section End -->

											<!-- Section Start -->
											<section class="">
												<div class="row">
													<div class="col-md-12 mt-100">
														<div class="col-md-2 col-sm-2 col-xs-12">
															<img src="images/fileimage/images/image19.jpg" alt="" title="" />
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12">
															<p><b>YOUR TRAVEL AGENT IN BOSTON</b><br />
															Cassandra Angus<br />
															American Express - Boston (HQ)<br />
															<img src="images/fileimage/images/image2.jpg" style="height: 40px;width: 200px;" alt="" title="" />						
														</div>
													</div>                
												</div>
												<br />
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-2 col-sm-2 col-xs-12">
															<img src="images/fileimage/images/image20.jpg" alt="" title="" />
														</div>
														<div class="col-md-8 col-sm-8 col-xs-12">
															<p><b>YOUR TRAVEL AGENT IN BOSTON</b><br />
															Cassandra Angus<br />
															American Express - Boston (HQ)<br />
															<img src="images/fileimage/images/image21.jpg" style="height: 35px;width: 180px;padding-top:5px;" alt="" title="" />
														</div>
													</div>                
												</div>    
												<!-- <footer class="pdf">    
												  <div class="">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3 col-sm-3 col-xs-12 footer-height">
																<img class="footer-image" src="images/fileimage/images/image21.jpg" alt="" title="" />
															</div>
															<div class="col-md-9 col-sm-9 col-xs-12 footer-height text-right">
																<div class="footer-content">
																	<h1>FRANCE</h1>
																	<h3>April 08 2017</h3>
																</div>                        
															</div>
														</div>                
													</div>          		
												  </div>          		
												</footer> -->      
											</section> 
											<!-- Section End -->
									</div>

									<a href="" > <button type="button" class="btn btn-primary ">Word</button></a>
									<a href="{{ url('/download') }}" target="_blank"> <button type="button" class="btn btn-primary ">PDF</button></a>	
									<a href="" > <button type="button" class="btn btn-primary ">Flip Book</button></a>		    

									<!-- PDF view end -->
									
                                </div>
                            </div>
                        </div>
	                </div>
	            </div>
      </div>

@endsection