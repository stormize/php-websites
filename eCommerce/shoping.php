<?php 

session_start();

include "classes/products.php";
include "classes/customer.php";

$product = new products();
$customer = new customers();

if(isset($_COOKIE['Remember_User'])){
    $customer->Session('username', $_COOKIE['Remember_User']);
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
      <link rel="stylesheet" href="layout/css/semantic.min.css"> <!-- semantic.css File -->
        <link rel="stylesheet" href="layout/css/font-awesome.min.css"> <!-- font awesome.css file -->
        <link rel="stylesheet" href="layout/css/animate.css"> <!-- Animate.CSS File -->
        <link href="layout/css/hover.css" rel="stylesheet" media="all"> <!-- Hover.CSS File -->
        <link rel="stylesheet" href="layout/css/owl.carousel.css"> <!-- Carousal -->
        <link rel="stylesheet" href="layout/css/style.css"> <!-- CSS File -->
        <link rel="stylesheet" href="layout/css/media.css"> <!-- Media Query File -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> <!-- Font -->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <script src="layout/js/jquery.min.js"></script> <!-- Jquery Mini file -->

</head>
    <body>
<?php
 include "layout/header.php"; 
  if(isset($_SESSION['username'])){ 

  $row = $customer->Select_Customers($_SESSION['username']);
   $orders = $product->selectOrders($row['user_id']);
 ?>
  

  <section class="shoping">
    <div class="calculate">
      
      <?php $number = $product->selectOrdersNumbers($row['user_id']); ?>
      <h3>Number of Orders : <span><?php echo $number;?></span></h3>
      <h3>Total Price : 
      <?php 
      $total_price = 0;
        foreach ($orders as $key) { 
          $total_price = $total_price + $key['total_price'];
        }
        echo "<span>".$total_price." $</span>";
?>
      </h3>
      
    </div>
   
 <?php      
  

  foreach ($orders as $key) {   // Select Orders for this user

     $pro = $product->selectCurrentItem($key['pro_id']);  // Select Product for this user
     foreach ($pro as $value) { ?>
<div class="orders">
  
  <img src="product_image/<?php echo $value['pic_name']; ?>">     
  <h2><?php echo $value['pro_name']; ?></h2>
  <p>Quantity you are Taken : <span><?php echo $key['avail_quantity']; ?></span></p>
</div>



<?php     }
 }

?>

  </section>

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
