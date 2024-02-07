<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/indexstyle.css">
    <title>Servicing is easier than ever!</title>
</head>
<body>
      <!-- Header -->
  <section id="header">
    <div class="header container">
      <div class="nav-bar">
        <div class="brand">
          <a href="#hero">
            <h1>Tuktak</h1>

          </a>
        </div>
        <div class="nav-list">
          <div class="hamburger">
            <div class="bar"></div>
          </div>
          <ul>    
            <li><a href="#" data-after="Home">Home</a></li>
            <li><a href="Views/registrationView.php">Create Account</a></li>
            <li><a href="views/login.php">Login</a></li>
            <li><a href="#services" data-after="About">Services</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- End Header -->

   <!-- Hero Section  -->
  <section id="hero">
    <div class="hero container">
      <div>
        <h1>Welcome to, <span></span></h1>
        <h1>Your TUKTAK Service <span></span></h1>
        <h1>within your hand <span></span></h1>
      </div>
    </div>
  </section>
  <!-- End Hero Section  -->




  <section id="services">
        <div class="services container">
            <div class="service-top">
                <h1 class="section-title">Services</h1>
                <p>We provide all kinds of home services for a family, bachelors, and Office!</p>
            </div>
            <div class="service-bottom">
                <?php
                    $servicesResult = getServices();
                    while ($row = $servicesResult->fetch_assoc()) {
                        echo '<div class="service-item">';
                        echo '<h2>' . $row['service_name'] . '</h2>';
                        echo '<p>' . $row['service_description'] . '</p>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </section>




    <div class="container">
            <div class="brand">
                <h1><span>About</span> Us</h1>
            </div>
            <h2>Your Complete Home Maintenance Service!</h2>
            </div>
            <p>Copyright © Company. All rights reserved</p>
        </div>
    
    

    

    
       

</body>
</html>
