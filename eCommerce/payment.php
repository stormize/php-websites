<?php 
session_start();
  include 'classes/customer.php';
  include "classes/products.php";
  
  $product = new products();
  $customer = new Customers();

// in case if user enter Direct into this Page
if(isset($_GET['id'])){


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

foreach ($product->selectCurrentItem($_GET['id']) as $value) { 
          $category = $product->selectCurrentCategory($value['cat_id']);
  ?>

<div class="products">
  
  <img src="product_image/<?php echo $value['pic_name']; ?>">
  <p>Name: <span><?php echo $value['pro_name'];?></span></p>
  <p>Available Quantity : <span><?php echo $value['avail_quantity']; ?></span></p>

  <form action="card.php" method="POST">

    <?php 
      $row = $customer->Select_Customers($_SESSION['username']);
    ?> 

    <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
    <input type="hidden" name="pro_id" value="<?php echo $value['pro_id'] ?>">
    <input type="hidden" name="price" value="<?php echo $value['price'] ?>">

    <label for="available">Quantity you want: </label>
    <input type="number" min="1" max="<?php echo $value['avail_quantity']; ?>" name="available">
    <input type="submit" name="buy" value="Buy">

</form>

</div>
<?php     } // End Foreach
          
?>

  
  
  <script src="layout/js/jquery.min.js"></script>
  <script src="layout/js/jquery-ui.min.js"></script>
  <script src="layout/js/owl.carousel.min.js"></script> <!-- Owl-Carousel.js Mini file -->
    <script src="layout/js/wow.min.js"></script> 
    <script>new WOW().init();</script> <!-- Activate WOW.js File -->
    <script src="layout/js/semantic.min.js"></script> <!-- semantic Js File -->
  <script src="layout/js/custom.js"></script>
    
 
</body>
</html>
<?php 
}
else{
  header("Location: index.php");
}
?>