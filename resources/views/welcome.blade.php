<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="restaurant, food, reservaciones">
    <title>Restaurant</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- font -->
    <link href="//fonts.googleapis.com/css?family=Pacifico&amp;subset=latin-ext,vietnamese" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
    <!-- //font -->
</head>
<body>
    
    <div class="banner jarallax">
        <div class="agileinfo-dot">
            <div class="header">
                <div class="container">
                    <nav class="navbar navbar-default">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapese-1">
                                <span class="sr-only">Toggle Naviation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="agileits-logo">
                                <h1><a href="http://">Restaurant <span>name</span></a></h1>
                            </div>
                        </div>

                        <div class="collapse navbar-collapse nav-will" id="bs-axample-navbar-collapse-1">
                            <nav class="">
                                <ul class="nav navbar-nav">
                                    <li class="active">
                                        <a href="http://">Home</a>
                                    </li>
                                    <li class="">
                                        <a href="#about" class="scroll button1">About</a>
                                    </li>
                                    <li class="">
                                        <a href="#services" class="scroll button1">Services</a>
                                    </li>
                                    <li class="">
                                        <a href="#specials" class="scroll button1">Specials</a>
                                    </li>
                                    <li class="">
                                        <a href="#mail" class="scroll button1">Mail Us</a>
                                    </li>
                                    <li class="">
                                        <a href="{{ url('/app_login') }}">Clients</a>
                                    </li>
                                    <li class="">
                                        <a href="{{ route('login_socios') }}">Companies</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="w3layouts-banner-info">
				<div class="container">
					<div class="w3layouts-banner-text">
						<h4><span>R</span></h4>
						<h2>Lorem ipsum <span>dolor</span> sit amet, consectetur</h2>
						<p>Morbi non nulla vulputate, aliquet nisl ac, viverra magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						<div class="w3-button">
							<ul>
								<li><a href="#specials" class="scroll button1">Dishes</a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal" class="button2">More</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal about-modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
                    <h4 class="modal-title">Royal Food</h4>
                    <h5>24 Sept 2017</h5>
                </div> 
                <div class="modal-body">
                    <div class="agileits-w3layouts-info">
                        <img src="{{ asset('images/2.jpg') }} " alt="" />
                        <p>Duis venenatis, turpis eu bibendum porttitor, sapien quam ultricies tellus, ac rhoncus risus odio eget nunc. Pellentesque ac fermentum diam. Integer eu facilisis nunc, a iaculis felis. Pellentesque pellentesque tempor enim, in dapibus turpis porttitor quis. Suspendisse ultrices hendrerit massa. Nam id metus id tellus ultrices ullamcorper.  Cras tempor massa luctus, varius lacus sit amet, blandit lorem. Duis auctor in tortor sed tristique. Proin sed finibus sem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //modal -->

    <!-- welcome -->
    <div class="welcome" id="about">
        <div class="container">
            <div class="col-md-6 agileits_welcome_grid_left">
                <h3>About Us!</h3>
                <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis pretium ultricies. Phasellus mattis, eros vitae accumsan malesuada</h5>
                <p >Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                        sed quia consequuntur magni dolores eos qui ratione voluptatem sequi 
                        nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, 
                        consectetur, adipisci velit. Ut enim ad minima 
                        veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, 
                        nisi ut aliquid ex ea commodi consequatur? <i>Quis autem vel eum iure 
                        reprehenderit qui in ea voluptate velit esse quam nihil molestiae 
                        consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla 
                        pariatur?</i></p>
            </div>
            <div class="col-md-6 agileits_welcome_grid_right">
                <img src="images/2.jpg" alt=" " class="img-responsive" />
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //welcome -->

    <!-- markets -->
    <div class="markets" id="services">
        <div class="container">
            <div class="wthree-heading">
                <h3>Nuestros Servicios</h3>
            </div>
            <div class="markets-grids">
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-left">
                            <i class="fa fa-cutlery" aria-hidden="true"></i>
                        </div>
                        <div class="icon-right">
                            <h5>Suspendisse</h5>
                            <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-left">
                            <i class="fas fa-glass-martini"></i>
                        </div>
                        <div class="icon-right">
                            <h5>Aliquam</h5>
                            <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-left">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                        </div>
                        <div class="icon-right">
                            <h5>Consectetur</h5>
                            <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-left">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <div class="icon-right">
                            <h5>Bibendum</h5>
                            <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-left">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </div>    
                        <div class="icon-right">
                            <h5>Vestibulum</h5>
                            <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-left">
                            <i class="fa fa-coffee" aria-hidden="true"></i>
                        </div>
                        <div class="icon-right">
                            <h5>Fermentum</h5>
                            <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //markets -->

    <!-- gallery -->
    <div class="gallery" id="specials">
        <div class="container">
            <div class="wthree-heading">
                <h3>Nuestros Escpeciales</h3>
            </div>
            <div class="gallery-grids">
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g1.jpg" data-lightbox="example-set" data-title=""></a>
                                <img src="images/g1.jpg" alt="" />
                                <figcaption>
                                </figcaption>	
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g2.jpg" data-lightbox="example-set" data-title="">
                                <img src="images/g2.jpg" alt="" />
                                <figcaption>
                                </figcaption>	
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g3.jpg" data-lightbox="example-set" data-title="">
                                <img src="images/g3.jpg" alt="" />
                                <figcaption>
                                </figcaption>		
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g4.jpg" data-lightbox="example-set" data-title="">                                          <img src="images/g4.jpg" alt="" />
                                <figcaption>
                                </figcaption>	
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g5.jpg" data-lightbox="example-set" data-title="">                                          <img src="images/g5.jpg" alt="" />
                                <figcaption>
                                </figcaption>	
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g6.jpg" data-lightbox="example-set" data-title="">
                                <img src="images/g6.jpg" alt="" />
                                <figcaption>
                                </figcaption>		
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g7.jpg" data-lightbox="example-set" data-title="">
                                <img src="images/g7.jpg" alt="" />
                                <figcaption>
                                </figcaption>	
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g1.jpg" data-lightbox="example-set" data-title="">
                                <img src="images/g1.jpg" alt="" />
                                <figcaption>
                                </figcaption>	
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g2.jpg" data-lightbox="example-set" data-title="">
                                <img src="images/g2.jpg" alt="" />
                                    <figcaption>
                                    </figcaption>		
                                </a>
                            </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g3.jpg" data-lightbox="example-set" data-title="">
                                <img src="images/g3.jpg" alt="" />
                                <figcaption>
                                </figcaption>		
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g4.jpg" data-lightbox="example-set" data-title="">
                                <img src="images/g4.jpg" alt="" />
                                <figcaption>
                                </figcaption>		
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-md-3 gallery-grid">
                    <div class="grid">
                        <figure class="effect-apollo">
                            <a class="example-image-link" href="images/g5.jpg" data-lightbox="example-set" data-title="">
                                <img src="images/g5.jpg" alt="" />
                                <figcaption>
                                </figcaption>		
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="clearfix"> </div>
                <script src="js/lightbox-plus-jquery.min.js"> </script>
            </div>
        </div>
    </div>
    <!-- //gallery -->

    <!-- contact -->
    <div class="contact" id="mail">
        <div class="container">
            <div class="wthree-heading">
                <h3>Cantacto</h3>
            </div>
            <div class="agile-contact-grids">
                <div class="col-md-6 agile-contact-left">
                    <div class="address-grid">
                        <h4>Our Address</h4>
                        <ul class="w3_address">
                            <li><i class="fas fa-map-marker"></i> 1234k Avenue, 4th block, <span>New York City.</span></li>
                            <li><i class="far fa-envelope"></i> <a href="mailto:info@example.com">info@example.com</a></li>
                            <li><i class="fas fa-mobile-alt"></i> +1234 567 567</li>
                        </ul>
                    </div>
                    <div class="contact-form">
                        <h4>Contactanos</h4>
                        <form action="#" method="post">
                            <div class="styled-input agile-styled-input-top">
                                <input type="text" name="Name" required="">
                                <label>Name</label>
                                <span></span>
                            </div>
                            <div class="styled-input">
                                <input type="email" name="Email" required=""> 
                                <label>Email</label>
                                <span></span>
                            </div> 
                            <div class="styled-input">
                                <input type="text" name="Subject" required="">
                                <label>Subject</label>
                                <span></span>
                            </div>
                            <div class="styled-input">
                                <textarea name="Message" required=""></textarea>
                                <label>Message</label>
                                <span></span>
                            </div>	 
                            <input type="submit" value="SEND">
                        </form>
                    </div>
                </div>
                <div class="col-md-6 agile-contact-right">
                    <div class="agileits-map">
                        <h4>Nuestra Ubicacion</h4>
                    </div>
                    <div class="map-grid">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387142.8400948023!2d-74.25819082602831!3d40.70583163923578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1470295981376" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //contact -->
    
    <!-- footer -->
    <div class="footer">
        <div class="container">
            <div class="copyright">
                <p>© 2020 Royal Food . All Rights Reserved | Design by <a href="http://w3layouts.com/"> W3layouts</a> </p>
            </div>
        </div>
    </div>
    <!-- //footer -->

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){		
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <script src="{{ asset('js/jarallax.js') }}"></script>
	<!--<script src="{{ asset('js/SmoothScroll.min.js') }}"></script>-->
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
	<script src="{{ asset('js/responsiveslides.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/move-top.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/easing.js') }}"></script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
    <!-- //here ends scrolling icon -->    
</body>
</html>
