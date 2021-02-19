<?php
error_reporting(0);
include 'dbconnect.php';
session_start();
if (!isset($_SESSION['loggedin'])) {
  echo "<script> window.alert('Please sign in first.'); 
    window.location='login.php'; </script>";
} else {
  $sql = "select * from users where username=" . "'" . $_SESSION['username'] . "'";
  $result = mysqli_query($conn, $sql) or die('Error ' . mysqli_error($conn));
  $row = mysqli_fetch_array($result);
  $state = $row['state'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = $_SESSION['username'];
  $crop = $_POST["crop"];
  $quantity = $_POST["quantity"];
  $price = $_POST['price'];
  $sql = "INSERT INTO `global_market` (`username`, `state`, `crop`, `quantity` ,`price`) VALUES ( '$username', '$state', '$crop', '$quantity','$price');";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script> window.alert('Your crop has been made available to the market.'); 
            window.location='show-market.php'; </script>";
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/loginstyle.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">

  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/art.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/nav.php">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/carousel.css">
  <link rel="stylesheet" href="assets/css/loginstyle.css">
  <title>Connect to Global Market</title>
</head>

<body>

  <div class="bodyoflogin">


    <div class="containermain" data-aos="flip-left">
      <div class="logo" style="margin-top: 0.02px;">
        <p style="font-family: 'Roboto Mono', monospace; height:50px;">List your product on the global market.</p>
      </div>

      <div class="login-item">
        <form action="market.php" method="post" class="form form-login">
          <div class="form-field">

            <input style="height: 55px;" type="text" class="form-control" id="crop" name="crop" aria-describedby="emailHelp" placeholder="Name of Crop" required>
          </div>

          <div class="form-field">

            <input style="height: 55px;" type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity(in KGs)" required>
          </div>
          <div class="form-field">

            <input style="height: 55px;" type="text" class="form-control" id="price" name="price" placeholder="Price" required>
          </div>
          <div class="form-field">

            <input style="height: 55px;" type="text" class="form-control" id="#" name="#" placeholder="City" required>
          </div>
          <div class="form-field">

            <input style="height: 55px;" type="text" class="form-control" id="#" name="#" placeholder="Contact Number" required>
          </div>

          <div class="form-field">
            <input type="submit" value="Sell your produce">
          </div>
          <div class="form-field">
            <input type="submit" onclick="window.location.href = 'show-market.php' " value="View market">
          </div>

        </form>
      </div>
    </div>
  </div>
  <!--FOOTER BEGINS-->

  <!-- Site footer -->
  <footer class="site-footer" style="font-family: 'Roboto Mono', monospace;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <h6>About</h6>
          <p class="text-justify">We at FARMERx aim to radically change the lives and technologies used by farmers to empower them and change their lives drastically.</p>
        </div>

        <div class="col-xs-6 col-md-3">

          <ul class="footer-links">

            <li><a href="index.php"><img src="assets/images/fmax.png"> </a></li>

          </ul>
        </div>

        <div class="col-xs-6 col-md-3">
          <h6>Quick Links</h6>
          <ul class="footer-links">
            <li><a href="weather.php">Weather</a></li>
            <li><a href="resources.php">Resources</a></li>
            <li><a href="map.php">Maps</a></li>
            <li><a href="msp.php">MSPs</a></li>
            <li><a href="market.php">Global Market</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
          </ul>
        </div>
      </div>
      <hr>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
          <p class="copyright-text">Copyright &copy; 2021 All Rights Reserved by
            <a href="index.php">FARMAX</a>.
          </p>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <ul class="social-icons">
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="dribbble" href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  </div>
  <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
  </div>

  <!--FOOTER ENDS-->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="assets/js/jquery-2.1.0.min.js"></script>

  <!-- Bootstrap -->
  <script src="assets/js/popper.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- Plugins -->
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/scrollreveal.min.js"></script>
  <script src="assets/js/waypoints.min.js"></script>
  <script src="assets/js/jquery.counterup.min.js"></script>
  <script src="assets/js/imgfix.min.js"></script>

  <!-- Global Init -->
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/nav.js"></script>
  <script>
    AOS.init();
    $(window).on("load", function() {
      $(".loader-wrapper").fadeOut("slow");
    });
  </script>
</body>

</html>