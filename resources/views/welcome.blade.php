<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Landing Page - Carcare</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->

        <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">

        <style>
          .mastheads {
    position: relative;
    height: 100vh;
    background-image: url('{{ asset('images/mechanic.jpg') }}');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center; /* optional */
    color: white; /* optional if you have text */
}

.mastheads::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Black with 50% opacity */
    z-index: 1;
}

.mastheads > * {
    position: relative;
    z-index: 2;
}


          .mastheads .overlay {
              position: absolute;
              top: 0; left: 0; right: 0; bottom: 0;
              background-color: rgba(0, 0, 0, 0.5);
              z-index: 1;
          }

          .mastheads .container {
              position: relative;
              z-index: 2;
          }
      </style>
      </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" href="#!">Carcare</a>
                <a class="btn btn-primary" href="{{ route('login') }}">Sign in</a>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="mastheads">
          <div class="container position-relative">
              <div class="row justify-content-center">
                  <div class="col-lg-8 text-center">
                      <h1 class="text-white mt-5">Welcome to Carcare</h1>
                      <p class="text-white mb-5">Book reliable car services anytime, anywhere with our easy-to-use platform.</p>
                      <a class="btn btn-primary" href="{{ route('register') }}">Get Started</a>
                  </div>
              </div>
          </div>
      </header>
      
        <!-- Icons Grid-->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-window m-auto text-primary"></i></div>
                            <h3>Fully Responsive</h3>
                            <p class="lead mb-0">Carcare works seamlessly on any device, giving you access to bookings on the go!</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-layers m-auto text-primary"></i></div>
                            <h3>Fast & Easy Booking</h3>
                            <p class="lead mb-0">Quickly schedule car services with just a few clicks using Carcare’s intuitive interface.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-terminal m-auto text-primary"></i></div>
                            <h3>Reliable Service Providers</h3>
                            <p class="lead mb-0">Find trusted mechanics and service centers verified by Carcare for quality and reliability.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Image Showcases-->
        <section class="showcase">
            <div class="container-fluid p-0">
                <div class="row g-0">
                  <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('/images/convenient.jpg')"></div>
                  <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Convenient Booking Process</h2>
                        <p class="lead mb-0">Carcare offers a streamlined booking experience that allows you to reserve services for your vehicle in minutes.</p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 text-white showcase-img" style="background-image: url('/images/up-to-date.jpeg')"></div>
                    <div class="col-lg-6 my-auto showcase-text">
                        <h2>Up-to-date with Modern Tech</h2>
                        <p class="lead mb-0">Carcare leverages the latest web technologies to deliver a smooth, mobile-friendly experience for booking your car services.</p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('/images/user-friendly.png')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Simple and User-Friendly</h2>
                        <p class="lead mb-0">Carcare is designed to make scheduling car maintenance and repair services easy, so you can focus on what matters most.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonials-->
        <section class="testimonials text-center bg-light">
            <div class="container">
                <h2 class="mb-5">Meet The Team!</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                          <img class="img-fluid rounded-circle mb-3" src="/images/crispe.jpeg" alt="Mechanic" />
                          <h5>James C.</h5>
                            <p class="font-weight-light mb-0">"Hipster/Tester"</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="/images/tom.jpg" alt="..." />
                            <h5>Reyzl Tom F.</h5>
                            <p class="font-weight-light mb-0">"Hacker"</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="/images/mijares.jpeg" alt="..." />
                            <h5>Luisse Angelo M.</h5>
                            <p class="font-weight-light mb-0">"Project Manager"</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                          <img class="img-fluid rounded-circle mb-3" src="/images/suazo.jpeg" alt="..." />
                          <h5>Ryan S.</h5>
                          <p class="font-weight-light mb-0">"Hustler"</p>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="/images/avilat.jpg" alt="..." />
                        <h5>Elmar John A.</h5>
                        <p class="font-weight-light mb-0">"Tester"</p>
                    </div>
                </div>
                <div class="col-lg-4">
                  <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                      <img class="img-fluid rounded-circle mb-3" src="/images/deticio.jpeg" alt="..." />
                      <h5>Charles Arvin D.</h5>
                      <p class="font-weight-light mb-0">"Hipster"</p>
                  </div>
              </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                        <ul class="list-inline mb-2">
                            <li class="list-inline-item"><a href="#!">About</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Contact</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Terms of Use</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Privacy Policy</a></li>
                        </ul>
                        <p class="text-muted small mb-4 mb-lg-0">&copy; Carcare 2025. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-facebook fs-3"></i></a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-twitter fs-3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!"><i class="bi-instagram fs-3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
