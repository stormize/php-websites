<?php 

include "classes/products.php";
$product = new products();


if(isset($_POST['buy'])){

  $user_id = $_POST['user_id'];
  $pro_id = $_POST['pro_id'];
  $quantity = $_POST['available'];
  $price = $_POST['price'];

  // Math Operation
  $total_price = $quantity * $price;

  $result = $product->insertOrder($user_id, $pro_id, $quantity, $total_price);

}


?>

<!doctype html>
<html lang="en">
<head> 
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE Combitability Meta -->
            <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile First Meta -->

           <title>Admin Panel</title>

      <link rel="stylesheet" href="layout/css/semantic.min.css"> <!-- semantic.css File -->
      <link rel="stylesheet" href="layout/css/font-awesome.min.css"> <!-- font awesome.css file -->
      <link rel="stylesheet" href="layout/css/animate.css"> <!-- Animate.CSS File -->
      <link href="layout/css/hover.css" rel="stylesheet" media="all"> <!-- Hover.CSS File -->
      <link rel="stylesheet" href="layout/css/jquery-ui.theme.min.css">
      <link rel="stylesheet" href="layout/css/style.css"> <!-- CSS File -->
      <link rel="stylesheet" href="layout/css/media.css"> <!-- Media Query File -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> <!-- Font -->
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
          <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
        <script src="layout/js/jquery.min.js"></script> <!-- Jquery Mini file -->
      <script src="layout/js/jquery.validate.min.js"></script>
        <script src="layout/js/script.js"></script> <!-- Externa Js File file - My File -->

</head>
    <body>
<?php
 include "layout/header.php"; 

   if(isset($_COOKIE['Remember_User']) || isset($_SESSION['username'])){ 

 ?>

<div class="card">
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
  <input type="hidden" name="business" value="aaaa@nnnn.com">

<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="item_name" value="Not Sauce-120x Bottle">
<input type="hidden" name="amount" value="5.95">
<input type="hidden" name="currency_code" value="USD">

<input type="hidden" name="hosted_button_id" value="8R66TRWDS4LZ8">

<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

</div>
 
 <?php } else { ?>
<div class="error"> 
              <h3>Errors</h3>
              <p>you must Log in firstly</p>
</div>              

<?php } ?>
  
  <script src="layout/js/jquery.min.js"></script>
  <script src="layout/js/jquery-ui.min.js"></script>
  <script src="layout/js/owl.carousel.min.js"></script> <!-- Owl-Carousel.js Mini file -->
    <script src="layout/js/wow.min.js"></script> 
    <script>new WOW().init();</script> <!-- Activate WOW.js File -->
    <script src="layout/js/semantic.min.js"></script> <!-- semantic Js File -->
  <script src="layout/js/custom.js"></script>
    
 
</body>
</html>