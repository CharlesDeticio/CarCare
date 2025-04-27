<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/chblue.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/theme-responsive.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/dtb/jquery.dataTables.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" media="screen">        
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.1.10.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/modernizr.js') }}"></script>
</head>
<body>
    <div id="layout">
        <div class="info-head">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="visible-md visible-lg text-left">
                            <li><a href="tel:+911234567890"><i class="fa fa-phone"></i> +91-1234567890</a></li>
                            <li><a href="mailto:contact@surfsidemedia.in"><i class="fa fa-envelope"></i>
                                    contact@carcaremedia.in</a></li>
                        </ul>
                        <ul class="visible-xs visible-sm">
                            <li class="text-left"><a href="tel:+911234567890"><i class="fa fa-phone"></i>
                                    +91-1234567890</a></li>
                            <li class="text-right"><a href="index.php/changelocation.html"><i
                                        class="fa fa-map-marker"></i> University of High Blood</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="visible-md visible-lg text-right">
                            <li><i class="fa fa-comment"></i> Live Chat</li>
                            <li><a href="index.php/changelocation.html"><i class="fa fa-map-marker"></i> University of High Blood</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <header id="header" class="header-v3">
            <nav class="flat-mega-menu">
                <label for="mobile-button"> <i class="fa fa-bars"></i></label>
                <input id="mobile-button" type="checkbox">

                <ul class="collapse">
                    <li class="title">
                        <a href="index.php.html"><img src="{{ ('images/carcare.jpg') }}"></a>
                    </li>
                    <!--<li> <a href="">My Cart/Booking</a>
                        <ul class="drop-down one-column hover-fade">
                            <li><a href="{{ route('cart') }}">Cart</a></li>
                            <li><a href="{{ route('booking') }}">Booking</a></li>
                        </ul>-->
                    </li>

                    <li> <a href="{{ route('dashboard') }}">Home</a>
                    </li>

                    <li> <a href="{{ route('usershop') }}">Shop</a>
                    </li>

                    </li>    
                    <li> <a href="{{ Auth::user()->name }}">My Account</a>
                            <ul class="drop-down one-column hover-fade">
                                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><form method="POST" action="{{ route('logout') }}">
                    <a href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                        </a>
                    @csrf
                    </li>
                            </ul>

                    
                            
                    </li>

                    

                
                    
                    
                    <!--<li class="login-form"> <a href="index.php/register.html" title="Register">Register</a></li>
                    <li class="login-form"> <a href="login.html" title="Login">Login</a></li>
                    <li class="search-bar">
                    </li>-->
                </ul>
            </nav>
        </header>
        <section class="tp-banner-container">
            
            <div class="filter-title">
                <div class="title-header">
                    <h2 style="color:#fff;">BOOK A SERVICE</h2>
                    <p class="lead">Book a service at very affordable price, </p>
                </div>
                <div class="filter-header">
                    <form id="sform" action="searchservices" method="post">                        
                        <input type="text" id="q" name="q" required="required" placeholder="What Services do you want?"
                            class="input-large typeahead" autocomplete="off">
                        <input type="submit" name="submit" value="Search">
                    </form>
                </div>
            </div>
        </section>
        
            <div class="content_info content_resalt">
                <div class="container" style="margin-top: 40px;">
                    <div class="row">
                    </div>
                </div>
                
            </div>
            <div class="semiboxshadow text-center">
                <img src="{{ ('assets/img/img-theme/shp.png') }}" class="img-responsive" alt="">
            </div>
            <div class="section-title-01 honmob">
            <div class="bg_parallax image_01_parallax"></div>
            <div class="opacy_bg_02">
                <div class="container">
                    <h1>All Services</h1>
                    <div class="crumbs">
                        <!--<ul>
                            <li><a href="index.html">Home</a></li>
                            <li>/</li>
                            <li>Service Categories</li>
                        </ul>-->
                    </div>
                </div>
            </div>
        </div>
        <section class="content-central">
            <div class="container">
                <div class="row" style="margin-top: -30px;">
                    <div class="titles">
                        <!--<h2>All <span>Services</span></h2>
                        <i class="fa fa-plane"></i>
                        <hr class="tall">-->
                    </div>
                </div>
            </div>
            <div class="content_info" style="margin-top: -70px;">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="services-lines full-services">
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/1.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Turbo"></a></i>
                                    <h5>Turbo</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/2.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Ligid"></a></i>
                                    <h5>Ligid</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/3.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Wheel"></a></i>
                                    <h5>Wheel</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/4.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Electrical Tape"></a></i>
                                    <h5>Electrical Tape</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/5.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Shower Filter"></a></i>
                                    <h5>Shower Filter</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/6.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Oil"></a></i>
                                    <h5>Oil</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/7.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Lights"></a></i>
                                    <h5>Lights</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/8.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Belt"></a></i>
                                    <h5>Belt</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/9.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/10.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/11.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/12.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/13.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/14.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/15.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Car"></a></i>
                                    <h5>Car</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/16.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/17.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret &amp; Secret"></a></i>
                                    <h5>Secret &amp; Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/18.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/19.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/20.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/21.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                            <li>
                                <div class="item-service-line">
                                    <i class="fa"><a href="servicesbycategory/22.html"><img class="icon-img"
                                                src="images/sercat/service-icon.png" alt="Secret"></a></i>
                                    <h5>Secret</h5>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="content_info content_resalt">
                <div class="container">
                    <div class="row">
                        <div class="titles">
                        </div>
                    </div>
                </div>
            </div>

            
            <!--<div>
                <div class="container">
                    <div class="row">
                        <div class="titles">
                            <h2><span>Appliance</span>Services</h2>
                            <i class="fa fa-plane"></i>
                            <hr class="tall">
                        </div>
                    </div>
                </div>
                <div id="boxes-carousel">
                    <div>
                        <a class="g-list" href="service-details/ac-wet-servicing.html">
                            <div class="img-hover">
                                <img src="{{ ('images/services/thumbnails/thumbnail.jpg') }}" alt="" class="img-responsive">
                            </div>

                            <div class="info-gallery">
                                <h3>AC Wet Servicing</h3>
                                <hr class="separator">
                                <p>AC Wet Servicing</p>
                                <div class="content-btn"><a href="service-details/ac-wet-servicing.html"
                                        class="btn btn-primary">Book Now</a></div>
                                <div class="price"><span>&#36;</span><b>From</b>200</div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a class="g-list" href="service-details/bedroom-deep-cleaning.html">
                            <div class="img-hover">
                                <img src="{{ ('images/services/thumbnails/thumbnail.jpg') }}" alt="" class="img-responsive">
                            </div>

                            <div class="info-gallery">
                                <h3>Bedroom Deep Cleaning</h3>
                                <hr class="separator">
                                <p>Bedroom Deep Cleaning</p>
                                <div class="content-btn"><a href="service-details/bedroom-deep-cleaning.html"
                                        class="btn btn-primary">Book Now</a></div>
                                <div class="price"><span>&#36;</span><b>From</b>300</div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a class="g-list" href="service-details/dining-chair-shampooing.html">
                            <div class="img-hover">
                                <img src="{{ ('images/services/thumbnails/thumbnail.jpg') }}" alt="" class="img-responsive">
                            </div>

                            <div class="info-gallery">
                                <h3>Dining Chair Shampooing</h3>
                                <hr class="separator">
                                <p>Dining Chair Shampooing</p>
                                <div class="content-btn"><a href="service-details/dining-chair-shampooing.html"
                                        class="btn btn-primary">Book Now</a></div>
                                <div class="price"><span>&#36;</span><b>From</b>400</div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a class="g-list" href="service-details/carpet-shampooing.html">
                            <div class="img-hover">
                                <img src="{{ ('images/services/thumbnails/thumbnail.jpg') }}" alt="" class="img-responsive">
                            </div>

                            <div class="info-gallery">
                                <h3>Carpet Shampooing</h3>
                                <hr class="separator">
                                <p>Carpet Shampooing</p>
                                <div class="content-btn"><a href="service-details/carpet-shampooing.html"
                                        class="btn btn-primary">Book Now</a></div>
                                <div class="price"><span>&#36;</span><b>From</b>200</div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a class="g-list" href="service-details/fabric-sofa-shampooing.html">
                            <div class="img-hover">
                                <img src="{{ ('images/services/thumbnails/thumbnail.jpg') }}" alt="" class="img-responsive">
                            </div>

                            <div class="info-gallery">
                                <h3>Fabric Sofa Shampooing</h3>
                                <hr class="separator">
                                <p>Fabric Sofa Shampooing</p>
                                <div class="content-btn"><a href="service-details/fabric-sofa-shampooing.html"
                                        class="btn btn-primary">Book Now</a></div>
                                <div class="price"><span>&#36;</span><b>From</b>211</div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a class="g-list" href="service-details/bathroom-deep-cleaning.html">
                            <div class="img-hover">
                                <img src="{{ ('images/services/thumbnails/thumbnail.jpg') }}" alt="" class="img-responsive">
                            </div>

                            <div class="info-gallery">
                                <h3>Bathroom Deep Cleaning</h3>
                                <hr class="separator">
                                <p>Bathroom Deep Cleaning</p>
                                <div class="content-btn"><a href="service-details/bathroom-deep-cleaning.html"
                                        class="btn btn-primary">Book Now</a></div>
                                <div class="price"><span>&#36;</span><b>From</b>233</div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a class="g-list" href="service-details/floor-scrubbing-polishing.html">
                            <div class="img-hover">
                                <img src="{{ ('images/services/thumbnails/thumbnail.jpg') }}" alt="" class="img-responsive">
                            </div>

                            <div class="info-gallery">
                                <h3>Floor Scrubbing &amp; Polishing</h3>
                                <hr class="separator">
                                <p>Floor Scrubbing &amp; Polishing</p>
                                <div class="content-btn"><a href="service-details/floor-scrubbing-polishing.html"
                                        class="btn btn-primary">Book Now</a></div>
                                <div class="price"><span>&#36;</span><b>From</b>411</div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a class="g-list" href="service-details/mattress-shampooing.html">
                            <div class="img-hover">
                                <img src="{{ ('images/services/thumbnails/thumbnail.jpg') }}" alt="" class="img-responsive">
                            </div>

                            <div class="info-gallery">
                                <h3>Mattress Shampooing</h3>
                                <hr class="separator">
                                <p>Mattress Shampooing</p>
                                <div class="content-btn"><a href="service-details/mattress-shampooing.html"
                                        class="btn btn-primary">Book Now</a></div>
                                <div class="price"><span>&#36;</span><b>From</b>222</div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a class="g-list" href="service-details/kitchen-deep-cleaning.html">
                            <div class="img-hover">
                                <img src="{{ ('images/services/thumbnails/thumbnail.jpg') }}" alt="" class="img-responsive">
                            </div>

                            <div class="info-gallery">
                                <h3>Kitchen Deep Cleaning</h3>
                                <hr class="separator">
                                <p>Kitchen Deep Cleaning</p>
                                <div class="content-btn"><a href="service-details/kitchen-deep-cleaning.html"
                                        class="btn btn-primary">Book Now</a></div>
                                <div class="price"><span>&#36;</span><b>From</b>111</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>-->
        </section>
        <footer id="footer" class="footer-v1">
            <div class="container">
                <div class="row visible-sm visible-xs">
                    <div class="col-md-6">
                        <h3 class="mlist-h">CONTACT US</h3>
                        <ul class="contact_footer mlist">
                            <li class="location">
                                <i class="fa fa-map-marker"></i> <a href="#"> Faridabad, Haryana, India</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <a
                                    href="mailto:contact@surfsidemedia.in">contact@surfsidemedia.in</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> <a href="tel:+911234567890">+91-1234567890</a>
                            </li>
                        </ul>
                        <ul class="social mlist-h">
                            <li class="facebook"><span><i class="fa fa-facebook"></i></span><a href="#"></a></li>
                            <li class="twitter"><span><i class="fa fa-twitter"></i></span><a href="#"></a></li>
                            <li class="github"><span><i class="fa fa-instagram"></i></span><a href="#"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-down">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="nav-footer">
                                <li><a href="about-us.html">About Us</a> </li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                                <li><a href="terms-of-use.html">Terms of Use</a></li>
                                <li><a href="privacy.html">Privacy</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p class="text-xs-center crtext">&copy; 2024 Carcare. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>                
            </div>            
        </footer>
    </div>
    <script type="text/javascript" src="{{ asset('assets/js/nav/jquery.sticky.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/totop/jquery.ui.totop.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/accordion/accordion.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/maps/gmap3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/fancybox/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/carousel/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/filters/jquery.isotope.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/twitter/jquery.tweet.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/flickr/jflickrfeed.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/theme-options/theme-options.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/theme-options/jquery.cookies.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap/bootstrap-slider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dtb/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dtb/jquery.table2excel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dtb/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/validation-rule.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap3-typeahead.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript">
        jQuery(Secret).ready(function () {
            jQuery('.tp-banner').show().revolution({
                dottedOverlay: "none",
                delay: 5000,
                startwidth: 1170,
                startheight: 480,
                minHeight: 250,
                navigationType: "none",
                navigationArrows: "solo",
                navigationStyle: "preview1"
            });
        });
    </script>
</body>
</html>