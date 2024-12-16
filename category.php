<?php
session_start(); // Start the session

// Store the current page URL as the last visited page in session
$_SESSION['last_visited_page'] = $_SERVER['REQUEST_URI'];
?>
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
                    <a class="nav-link "  href="index.php"><b>Home</b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#category"><b>Category</b></a>
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


    <!-- category section -->
    <section id="category" class="category">
      <div class="container-fluid  py-5">
              <div class="container py-5">
                <div class="col-sm-12">
                  <div class="headline text-center mb -5">
                    <h2 class="pb-3 position-relative d-inline-block">CATEGORY</h2>
                  </div>
                </div>
                  <div class="row g-4">
                      <div class="col-lg-12">
                          <div class="row g-4">
                              <div class="col-xl-3">
                                  <div class="input-group w-100 mx-auto d-flex">
                                      <input type="search" class="form-control p-3" placeholder="keywords"
                                          aria-describedby="search-icon-1">
                                      <span id="search-icon-1" class="input-group-text p-3"><i
                                              class="fa fa-search"></i></span>
                                  </div>
                              </div>
                              <div class="col-6"></div>
                              <div class="col-xl-3">
                                  <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                      <label for="Electro">Default Sorting:</label>
                                      <select id="Electro" name="Electrolist" class="border-0 form-select-sm bg-light me-3"
                                          form="electroform">
                                          <option value="Newest">Newest</option>
                                          <option value="Popular">Popular</option>
                                          <option value="Price">Price</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="row g-4">
                              <div class="col-lg-3">
                                  <div class="row g-4">
                                      <div class="col-lg-12">
                                          <div class="mb-3">
                                              <h4>Categories</h4>
                                              <ul class="list-unstyled electro-categorie">
                                                  <li>
                                                      <div class="d-flex justify-content-between electro-name">
                                                          <a href="mobile.php"><i class="fas fa-mobile-alt me-2"></i>Mobile</a>
                                                      </div>
                                                  </li>
                                                  <li>
                                                      <div class="d-flex justify-content-between electro-name">
                                                          <a href="speaker.php"><i class="fab fa-speaker-deck -alt me-2"></i>Speakers</a>
                                                      </div>
                                                  </li>
                                                  <li>
                                                      <div class="d-flex justify-content-between electro-name">
                                                          <a href="headphone.php"><i class="fas fa-headphones -alt me-2"></i>Headphone</a>
                                                      </div>
                                                  </li>
                                                  <li>
                                                      <div class="d-flex justify-content-between electro-name">
                                                          <a href="router.php"><i class="fas fa-network-wired -alt me-2"></i>Router</a>
                                                      </div>
                                                  </li>
                                                  <li>
                                                      <div class="d-flex justify-content-between electro-name">
                                                          <a href="storage.php"><i class="fas fa-hdd -alt me-2"></i>Storage</a>
                                                      </div>
                                                  </li>
                                              </ul>

                                              <ul class="list-group">
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="display_type" value="AMOLED"> AMOLED
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="display_type" value="LCD"> LCD
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="display_type" value="OLED"> OLED
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="display_type" value="Super AMOLED"> Super AMOLED
                                                    </label>
                                                </li>
                                            </ul>

                                              <h5 class="mt-4">Chipset Brand</h5>
                                              <ul class="list-group">
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="processor" value="Apple"> Apple
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="processor" value="MediaTek"> MediaTek
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="processor" value="Qualcomm"> Qualcomm
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="processor" value="Samsung"> Samsung
                                                    </label>
                                                </li>
                                            </ul>
                                              
                                              <h5 class="mt-4">RAM</h5>
                                              <ul class="list-group">
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="RAM" value="4GB"> 4GB
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="RAM" value="6GB"> 6GB
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="RAM" value="8GB"> 8GB
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="RAM" value="12GB"> 12GB
                                                    </label>
                                                </li>
                                            </ul>
                                              
                                              <h5 class="mt-4">Network</h5>
                                              <ul class="list-group">
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="Network" value="4G"> 4G
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label>
                                                        <input type="radio" name="Network" value="5G"> 5G
                                                    </label>
                                                </li>
                                            </ul>

                                          </div>
                                      </div>
                                      <div class="col-lg-12">
                                          <div class="mb-3">
                                              <h4 class="mb-2">Price</h4>
                                              <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput"
                                                  min="0" max="300000" value="0" oninput="amount.value=rangeInput.value">
                                              <output id="amount" name="amount" min-value="0" max-value="500"
                                                  for="rangeInput">0</output>
                                                  <button class="btn btn-danger">search</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-lg-9">
                              <div class="row g-4 justify-content-center" id="electro-container">
                                  <?php
                                  include "connection.php";

                                  // SQL query to fetch products
                                  $products_sql = "SELECT * FROM products";
                                  $products = $conn->query($products_sql);

                                  // Check if query returned any results
                                  if ($products->num_rows > 0) {
                                      while ($row = $products->fetch_assoc()) {
                                          $product_name = $row["product_name"];
                                          $description = $row["description"];
                                          $price = $row["price"];
                                          $image_url = $row["image_url"];
                                          $product_id = $row["product_id"];
                                          ?>

                                          <div class="col-sm-12 col-md-4 col-lg-4">
                                              <div class="card border-0">
                                                  <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Product Image" class="card-img-top">
                                                  <div class="card-body">
                                                      <h5 class="card-title text-secondary"><?php echo htmlspecialchars($product_name); ?></h5>
                                                      <div class="product-description">
                                                          <p class="description-short">
                                                              <?php echo nl2br(htmlspecialchars(substr($description, 0, 15))); ?>...
                                                          </p>
                                                          <p class="description-full" style="display: none;">
                                                              <?php echo nl2br(htmlspecialchars($description)); ?>
                                                          </p>
                                                          <a href="javascript:void(0);" class="show-more-btn" onclick="toggleDescription(this)">Show More</a>
                                                      </div>

                                                      <h4 class="card-title text-success">Rs <?php echo htmlspecialchars($price); ?></h4>

                                                      <div class="d-flex justify-content-between align-items-center mt-3">
                                                        <a href="checkout.php?product_id=<?= $row['product_id']; ?>" class="btn btn-danger">Buy Now</a>

                                                        <!-- Add to cart form -->
                                                        <form action="cartadd.php" method="POST" class="mb-0">
                                                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                                                            <button type="submit" name="add_to_cart" class="btn btn-danger">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </button>
                                                        </form>
                                                    </div>

                                                  </div>
                                              </div>
                                          </div>

                                          <?php
                                      }
                                  } else {
                                      echo "<p>No products found in this category.</p>";
                                  }
                                  ?>
                              </div>
                          </div>

                                  
                              </div>
                          </div>

                                  <div class="col-12">
                                      <div class="pagination d-flex justify-content-center mt-5">
                                          <a href="#" class="rounded">&laquo;</a>
                                          <a href="#" class="active rounded">1</a>
                                          <a href="#" class="rounded">2</a>
                                          <a href="#" class="rounded">3</a>
                                          <a href="#" class="rounded">4</a>
                                          <a href="#" class="rounded">5</a>
                                          <a href="#" class="rounded">6</a>
                                          <a href="#" class="rounded">&raquo;</a>
                                      </div>
                                  </div>
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
              <span class="countdown-price h3 d-block mb-4">Rs 1500.00 <del>RS 3000.00</del></span>
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
              <h5>Let's Start a Conversion!</h5>
              <h2 class="fw-bold">Contact Us</h2>
            </div>

            <div class="row">
              <div class="col-lg-5  col-md-5">
                <h4 class="fw-bold">Contact Us</h4>
                <ul class="info list-unstyle">

                  <li class="d-flex align-items-center">
                    <span class="pe-3 ti-location-pin fs-5"></span>
                    <p><a href="https://www.google.com/maps/place/Mahalaxmi+Municipality+Ward+8+office/@27.6434651,85.3707861,17.67z/data=!4m6!3m5!1s0x39eb10bc30cc9319:0x50f296487bbb6406!8m2!3d27.6438746!4d85.3725028!16s%2Fg%2F1hc0vr9r4?entry=ttu&g_ep=EgoyMDI0MDkyNC4wIKXMDSoASAFQAw%3D%3D"> Mahalaxmi-8, Lubhu,Lalitpur,Nepal</a></p>
                  </li>
                  <li class="d-flex align-items-center">
                    <span class="pe-3 ti-mobile fs-5"></span>
                    <p><a href="">+977 9876543201</a></p>
                  </li>
                </li>
                  <li class="d-flex align-items-center">
                    <span class="pe-3 ti-envelope fs-5"></span>
                    <p><a href="">ElectroNepal12@gmail.com</a></p>
                  </li>
                </ul>
              </div>
              <div class="col-lg-7 col-md-7 pt-lg-0 pt-md-0 pt-4">

                <form>
                  <div class= "row">
                    <div class="col-md-6">
                      <div class="form-group">
                      <input type="text" class="form-control" name="name" id="name" placeholder="Your name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email address">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <Textarea class="textarea" name="message" rows="4" id="message" placeholder="Enter your message"></textarea>
                        </div>
                    </div>
                      <div class="col-md- 12">
                        <button class="btn btn-danger"><span class="ti-rocket pe-2 fs-5"></span> Send Message</button>
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
    <script src="js/showmore.js"></script>
</body>


</style>"
</html>
