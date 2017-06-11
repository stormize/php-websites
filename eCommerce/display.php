<?php 
  session_start();
  include 'classes/customer.php';
  include "classes/products.php";
  
  $product = new products();
  $customer = new Customers();


if(isset($_POST['add_comment'])){

      $user_id = $_POST['user_id'];
      $comment = $_POST['comment'];
      $pro_id = $_POST['pro_id'];

      $result = $customer->insertComment($user_id, $comment, $pro_id);
      if($result){
      } else{
        echo "Error Please try Again";
      }
}

if(isset($_COOKIE['Remember_User']) || isset($_SESSION['username'])){ 


// in case if user enter Direct into this Page
if(isset($_GET['id'])){

  $product_id = $_GET['id'];

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



foreach ($product->selectCurrentItem($product_id) as $value) { 
          $category = $product->selectCurrentCategory($value['cat_id']);
  ?>

<div class="products">
  
  <img src="product_image/<?php echo $value['pic_name']; ?>">
  <p>Category : <span><?php echo $category['cat_name'];?></span></p>
  <p>Name: <span><?php echo $value['pro_name'];?></span></p>
  <p>Description: <span><?php echo $value['pro_desc']; ?></span></p>


<?php   
  $offer = $product->checkOffer($product_id);
  if($offer['offer'] != NULL){ ?>

  <p>Price After Offer : <span><?php echo $offer['offer']; ?> $</span></p>
  
<?php } else{ ?>
  <p>Price : <span><?php echo $value['price']; ?> $</span></p>

<?php  }

?>
  <p>Available Quantity : <span><?php echo $value['avail_quantity']; ?></span></p>

  <a href="payment.php?id=<?php echo $value['pro_id']?>" class="btn">Buy</a>
  <a href="index.php" class="btn">Return to Shoping</a>

</div>
<?php     } // End Foreach
          
?>

<section class="comment">
 
  <!-- Start Display Cntent in All Div [ Container ] -->

<?php 

$comment = $product->selectComments($product_id);
foreach ($comment as $value) {
?>
<div class="content">
  <div class="comment_name">
      <img src="users_image/<?php $img = $customer->selectCommentUser($value['user_id']); 
            echo $img['pic_name'];?>">
      <?php $name = $customer->selectCommentUser($value['user_id']); 
            echo "<p>".$name['user_name']."</p>";
      ?>
  </div>
  <div class="comment_content">
      <p><i class="fa fa-comment" aria-hidden="true"></i>
        <?php echo $value['content']; ?>
      </p>
  </div>
</div>
 
<?php } ?>
<!-- End Display --> 
<br> <br>
<hr> <br>
 

    <div class="add_comment">
      <?php 
      $user = $customer->Select_Customers($_SESSION['username']); 
      ?>

      <form action="display.php?id=<?php echo $product_id;?>" method="POST">
        <textarea name="comment" placeholder="Write a Comment"></textarea>
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
        <input type="hidden" name="pro_id" value="<?php echo $product_id ?>">
        <input type="submit" value="Comment" name="add_comment">
      </form>
    </div>
</section>


<?php 
}
else
{
?>
<link rel="stylesheet" type="text/css" href="layout/css/style.css">
      <link rel="stylesheet" href="layout/css/font-awesome.min.css">
<div class="comment">
<div class="comment_name">
      <h3><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Sorry you must select Product</h3>
      <a href="index.php">Go to Home Page</a>
  </div>
</div>
<?php 
}
?>


<!--  -->

 <?php } else { ?>
       <link rel="stylesheet" href="layout/css/style.css"> <!-- CSS File -->

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
