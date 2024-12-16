<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroNepal</title>
   
    <!-- Style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Themify icons -->
    <link rel="stylesheet" href="themify-icons/themify-icons.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="bootstrap css/css/bootstrap.min.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar">

  
    <!-- Navigation section -->
    <section id="header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <div class="container">
              <a class="navbar-brand" href="#">
                <img src="images/LOGO.png" class="img-fluid">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-align-justify navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#home"><b>Home</b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="category.php"><b>Category</b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="#special"><b>Special</b></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#contact"><b>Contact</b></a>
                  </li>
                  <li class="nav-item">
                      <?php
                      // Start the session if not already started
                      if (session_status() == PHP_SESSION_NONE) {
                          session_start();
                      }
                      
                      // Check if the user is logged in
                      if (isset($_SESSION['user_name'])) {
                          // If logged in, display Profile and Logout
                          echo '<a class="nav-link" href="profile.php"><b>Profile</b></a>';
                          echo '</li>';
                          echo '<li class="nav-item">';
                          echo '<a class="nav-link" href="logout.php"><b>Logout</b></a>';
                      } else {
                          // If not logged in, display Login
                          echo '<a class="nav-link" href="login.html"><b>Login</b></a>';
                      }
                      ?>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="cview.php"><b>Cart</b></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </section>

    <!-- Home section -->
     <section id="home" class="home pt-5 overflow-hidden">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="home-banner home-banner-1">
                    <div class="home-banner-text">
                        <h1>Ear Bud</h1>
                        <h2>35% Discount for This Product</h2>
                        <a href="#" class="btn btn-danger text-uppercase mt-4">Our Products</a>
                    </div>
                </div>
              </div>

              <div class="carousel-item">
                    <div class="home-banner home-banner-2">
                        <div class="home-banner-text">
                            <h1>Iphone 15</h1>
                            <h2>15% Discount for This Product</h2>
                            <a href="#" class="btn btn-danger text-uppercase mt-4">Our Products</a>
                        </div>
                    </div>
                  </div>
                </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true">
              <span class="ti-angle-left slider-icon"></span>
            </span>
            <span class="visually-hidden">prev</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true">
              <span class="ti-angle-right slider-icon"></span>
            </span>
            <span class="visually-hidden">next</span>
            </button>
            
          </div>
     

     <!-- Offer section -->
      <div class="offer">
        <div class="container">
          <div class="row">

            <!-- offer box one -->
      <div class="row">
        <div class="col-sm-6 col-lg-4 mb-lg-0 mb-4">
          <a href="#">
            <div class="offer-box text-center position-relative">
              <div class="offer-inner">
                <div class="offer-image position-relative overflow-hidden">
                  <img src="images/rm.png" alt="offer" class="img-fluid">
                  <div class="offer-overlay"></div>
                </div>
                <div class="offer-info">
                  <div class="offer-info-inner">
                    <p class="heading-bigger text-capitalize" >Sale 10% Off</p>
                    <p class="offer-title-1 text-uppercase font-weight-bold">Don't miss this chance</p>
                    <button type="button" class="btn btn-outline-danger text-uppercase mt-4">Shop Now</button>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      
        <!-- offer box two -->
        <div class="col-sm-6 col-lg-4 mb-lg-0 mb-4 d-flex flex-column justify-content-between">
          <a href="#">
            <div class="offer-box text-center position-relative mb-4 mb-sm-0 mb-lg-0">
              <div class="offer-inner">
                <div class="offer-image position-relative overflow-hidden">
                  <img src="images/samz.png" alt="offer" class="img-fluid">
                  <div class="offer-overlay"></div>
                </div>
                <div class="offer-info">
                  <div class="offer-info-inner">
                    <p class="heading-bigger text-capitalize">Sale 5% Off</p>
                    <p class="offer-title-1 text-uppercase font-weight-bold">Don't miss this chance</p>
                    <button type="button" class="btn btn-outline-danger text-uppercase mt-4">Shop Now</button>
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div><br>
      
      
      <!-- offer box three -->
      <div class="col-sm-6 col-lg-4 mb-lg-0 mb-4">
        <a href="#">
          <div class="offer-box text-center position-relative">
            <div class="offer-inner">
              <div class="offer-image position-relative overflow-hidden">
                <img src="images/sam1.jpg" alt="offer" class="img-fluid" >
                <div class="offer-overlay"></div>
              </div>
              <div class="offer-info">
                <div class="offer-info-inner">
                  <p class="heading-bigger text-capitalize">Sale 10% Off</p>
                  <p class="offer-title-1 text-uppercase font-weight-bold">Don't miss this chance</p>
                  <button type="button" class="btn btn-outline-danger text-uppercase mt-4">Shop Now</button>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    
    </section>

    <!-- Product Section -->
     <section id="Products" class="Products">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="headline text-center mb -5">
              <h2 class="pb-3 position-relative d-inline-block">FEATURE PRODUCTS</h2>
            
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 col-lg-4">
            <a href="#" class="d-block text-center mb-4">
              <div class="Product-list">
                <div class="Product-image position-relative">
                  
                  <img src="images/rm.png" class="img-fluid Product-image-first" >
                  <img src="images/rm.png" class="img-fluid Product-image-secondary" >
                </div>

                <div class="Product-name pt-3">
                  <h3 class="text-capitalize">Best Gaming Phones</h3>
                  <p class="mb-0 amount">Rs 90000.00 <del>Rs 105000.00</del></p>
                  <div class="py-1">
                    <span class="ti-star active"></span>
                    <span class="ti-star active"></span>
                    <span class="ti-star active"></span>
                    <span class="ti-star active"></span>
                    <span class="ti-star"></span>
                  </div>
                  <button type="button" class="add_to_cart">ADD TO CART</button>
                </div>
              </div>
            </a>
          </div>

          <div class="col-sm-6 col-lg-4">
            <a href="#" class="d-block text-center mb-4">
              <div class="Product-list">
                <div class="Product-image position-relative">
                  
                  <img src="images/sokyl.png" class="img-fluid Product-image-first" >
                  <img src="images/sokyl.png" class="img-fluid Product-image-secondary" >
                </div>

                <div class="Product-name pt-3">
                  <h3 class="text-capitalize">Best camera Phones</h3>
                  <p class="mb-0 amount">Rs 70000.00 <del>Rs 90000.00</del></p>
                  <div class="py-1">
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                  </div>
                  <button type="button" class="add_to_cart">ADD TO CART</button>
                </div>
              </div>
            </a>
          </div>

          <div class="col-sm-6 col-lg-4">
            <a href="#" class="d-block text-center mb-4">
              <div class="Product-list">
                <div class="Product-image position-relative">
                
                  <img src="images/redmi.png" class="img-fluid Product-image-first" >
                  <img src="images/redmi.png" class="img-fluid Product-image-secondary" >
                </div>

                <div class="Product-name pt-3">
                  <h3 class="text-capitalize">Best camera Phones</h3>
                  <p class="mb-0 amount">Rs 60000.00 <del>Rs 75000.00</del></p>
                  <div class="py-1">
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                  </div>
                  <button type="button" class="add_to_cart">ADD TO CART</button>
                </div>
              </div>
            </a>
          </div>

          <div class="col-sm-6 col-lg-4">
            <a href="#" class="d-block text-center mb-4">
              <div class="Product-list">
                <div class="Product-image position-relative">
                  
                  <img src="images/infinix.png" class="img-fluid Product-image-first" >
                  <img src="images/infinix.png" class="img-fluid Product-image-secondary" >
                </div>

                <div class="Product-name pt-3">
                  <h3 class="text-capitalize">Best camera Phones</h3>
                  <p class="mb-0 amount">Rs 45000.00 <del>Rs 60000.00</del></p>
                  <div class="py-1">
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                  </div>
                  <button type="button" class="add_to_cart">ADD TO CART</button>
                </div>
              </div>
            </a>
          </div>

          <div class="col-sm-6 col-lg-4">
            <a href="#" class="d-block text-center mb-4">
              <div class="Product-list">
                <div class="Product-image position-relative">
                
                  <img src="images/sam2.jpg" class="img-fluid Product-image-first" >
                  <img src="images/sam2.jpg" class="img-fluid Product-image-secondary" >
                </div>

                <div class="Product-name pt-3">
                  <h3 class="text-capitalize">Best Feature Phones</h3>
                  <p class="mb-0 amount">Rs 180000.00 <del>Rs 195000.00</del></p>
                  <div class="py-1">
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                  </div>
                  <button type="button" class="add_to_cart">ADD TO CART</button>
                </div>
              </div>
            </a>
          </div>

          <div class="col-sm-6 col-lg-4">
            <a href="#" class="d-block text-center mb-4">
              <div class="Product-list">
                <div class="Product-image position-relative">
                  
                  <img src="images/bs.png"  alt="Products" class="img-fluid Product-image-first">
                  <img src="images/bs.png" alt="Products"  class="img-fluid Product-image-secondary">
                </div>

                <div class="Product-name pt-3">
                  <h3 class="text-capitalize">Best Gaming Phones</h3>
                  <p class="mb-0 amount">Rs 80000.00 <del>Rs 95000.00</del></p>
                  <div class="py-1">
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                    <span class="ti-star"></span>
                  </div>
                  <button type="button" class="add_to_cart">ADD TO CART</button>
                </div>
              </div>
            </a>
          </div>


          <!-- Heavy Offer Product -->
           <div class="overflow-hidden my-5">
            <div class="row">
              <div class="col-sm-12 up_to_off">
                <img src="images/off.png" alt="offer" class="img-fluid w-100 ">
                <div class="up_to_content">
                  <h2>Heavy Discount Offer</h2>
                </div>
              </div>
            </div>
           </div>
        </div>
      </div>
     </section>


    <!-- Special section -->
     <section id="special" class="special">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="headline text-center mb -5">
              <h2 class="pb-3 position-relative d-inline-block">SPECIAL PRODUCTS</h2>
            </div>
          </div>

          <div class="col-sm-12 col-lg-7 text-center text-lg-start">
            <div class="countdown-container">
              <h2 class="text-uppercase">NEW PRODUCTS</h2>
              <p class="my-4">All Special Products are here</p>
              <ul class="list-unstyle countdown-counter">
                <li><span class="fs-1 d-block" id="days">00</span>Days</li>
                <li><span class="fs-1 d-block" id="hours">00</span>Hours</li>
                <li><span class="fs-1 d-block" id="min">00</span>Min</li>
                <li><span class="fs-1 d-block" id="sec">00</span>Sec</li>
              </ul>
              <span class="countdown-price h3 d-block mb-4">Rs 180000.00 <del>RS 200000.00</del></span>
              <button type="button" class="btn btn-danger">ADD TO CARD</button>
            </div>
          </div>
          <div class="col-sm-12 col-lg-5">
            <div class="special-img position-relative">
              <span class="sale">Special Offer</span>
              <img src="images/rm3.png" class="img-fluid" height="250px">
            </div>
          </div>

        </div>
      </div>
     </section>

     <!-- contact section -->
     <section id="contact">
          <div class="contact">
              <div class="container">
                  <div class="mb-5 text-center">
                      <h5>Let's Start a Conversation!</h5>
                      <h2 class="fw-bold">Contact Us</h2>
                  </div>

                  <div class="row">
                      <div class="col-lg-5 col-md-5">
                          <h4 class="fw-bold">Contact Us</h4>
                          <ul class="info list-unstyled">
                              <li class="d-flex align-items-center">
                                  <span class="pe-3 ti-location-pin fs-5"></span>
                                  <p><a href="https://www.google.com/maps/place/Mahalaxmi+Municipality+Ward+8+office/@27.6434651,85.3707861,17.67z/data=!4m6!3m5!1s0x39eb10bc30cc9319:0x50f296487bbb6406!8m2!3d27.6438746!4d85.3725028!16s%2Fg%2F1hc0vr9r4?entry=ttu&g_ep=EgoyMDI0MDkyNC4wIKXMDSoASAFQAw%3D%3D">Mahalaxmi-8, Lubhu, Lalitpur, Nepal</a></p>
                              </li>
                              <li class="d-flex align-items-center">
                                  <span class="pe-3 ti-mobile fs-5"></span>
                                  <p><a href="tel:+9779876543201">+977 9876543201</a></p>
                              </li>
                              <li class="d-flex align-items-center">
                                  <span class="pe-3 ti-envelope fs-5"></span>
                                  <p><a href="mailto:ElectroNepal12@gmail.com">ElectroNepal12@gmail.com</a></p>
                              </li>
                          </ul>
                      </div>
                      
                      <div class="col-lg-7 col-md-7 pt-lg-0 pt-md-0 pt-4">
                          <form id="contactForm" action="sendEmail.php" method="POST">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <input type="text" class="form-control" name="name" id="name" placeholder="Your name" required>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <input type="email" class="form-control" name="email" id="email" placeholder="Email address" required>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <textarea class="textarea form-control" name="message" rows="4" id="message" placeholder="Enter your message" required></textarea>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <button type="button" id="sendMessageBtn" class="btn btn-danger">
                                          <span class="ti-rocket pe-2 fs-5"></span> Send Message
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
     </section>




      <!-- footer section -->
      <footer>
        <div class="p-3 copyright">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-12 col-lg-6 p-1 p-lg-3 text-center text-lg-start">
                <p class="my-0">Copyright © 2024 <a href="#"> Electro Nepal</a> All Rights Reserved</p>
              </div>
              <div class="col-12 col-lg-6 p-1 p-lg-3 text-center text-lg-end" >
                <p class="my-0">Designed by <a href="#" target=" _blank">Hilson Shrestha</a>.</p>
              </div>
            </div>
          </div>
        </div>
      </footer>

      <!-- scroll back -->
       <div id="scrollUp" title="scroll To Top">
        <a href="#home"><span class="ti-arrow-up fs-4 text-white"></span></a>
       </div>


    <script src="https://kit.fontawesome.com/71e90eb4d2.js" crossorigin="anonymous"></script>
    <script src="bootstrap css/js/bootstrap.bundle.min.js"></script>
    <script src="js/count.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/sendEmail.js"></script>
</body>


</style>"
</html>
