<?php 
  include 'classes/customer.php';
  session_start();

  $customer = new Customers();

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

           <title>User Profile</title>

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
      <script src="layout/js/jquery.validate.min.js"></script>
        <script src="layout/js/script.js"></script> <!-- Externa Js File file - My File -->
</head>
<body>

  <?php include "layout/header.php"; 
  if(isset($_SESSION['username'])){ 

      $role = $admin->selectusers($_SESSION['username']);
    if($role['role'] == 0){
  ?>

       
<div class="profile">
        <div class="container">
      
      <div id="tabs">
        <ul>
          <li><a href="#tabs-1">Profile</a></li>
          <li><a href="#tabs-3">Add Product</a></li>
          <li><a href="#tabs-6">Edit Profile</a></li>
        </ul>
  <div id="tabs-1">
      <div class="admin-profile">

        <?php 
                $rows = $admin->selectusers($_SESSION['username']);
        ?>

          <img src="users_image/<?php echo $rows['pic_name']; ?>">
          <br>
          <div id="user-info">
              <div class="lable"><p><b>First name:</b> <?php echo $rows['first_name']; ?></p></div>
              <div class="lable"><p><b>Lsat name:</b> <?php echo $rows['last_name']; ?></p></div>
             <div class="lable"><p><b>user name:</b> <?php echo $rows['user_name']; ?></p></div>
              <div><p><b>E-mail:</b> <?php echo $rows['email']; ?></p></div>
              <div><p><b>ID:</b> <?php echo $rows['national_id']; ?></p></div>
              <div class="lable"><p><b>Phone:</b> <?php echo $rows['phone']; ?></p></div>
          </div>
      </div>
  </div>


  <div id="tabs-3">
    <div class="add-post">
        <form action="register.php" method="post" enctype="multipart/form-data">
        <select name="category">
          <?php 
                  foreach ($admin->selectFirstLevel() as $key) {
                     $cat_id=$key['cat_id'];
                      echo "<option value=".$cat_id.">" . $key['cat_name'] ."</option>";
                  }
              ?>
        </select><br><br>

        <label>Title:</label>
        <input type="text" name="title" placeholder="enter the title of the post" value="title"> <br> <br>
        
        <label>Picture</label>
        <input type="file" name="image">

        <label>Description:</label>
        <textarea name="description" >enter the description</textarea> <br> <br>
        
        <label>Price</label>
        <input type="number" name="price" value="price" placeholder="enter the price"> <br> <br>    
        
        <label>number</label>
        <input type="number" name="number" value="price" placeholder="enter the Number available"> <br> <br>    
        
        <input type="submit"  value="Add" name="add_Product">   
         
         </form>
      </div>
  </div>
             

            
  <div id="tabs-6">
    <div class="admin-profile">
        
        <form action="register.php" method="POST">
          <?php 
            $rows = $admin->selectusers($_SESSION['username']);
           ?>
          
          <input type="hidden" name="user_id" value="<?php echo $rows['user_id']; ?>">
          <input type="hidden" name="user_name" value="<?php echo $rows['user_name']; ?>">
          
          <label for="first_name">first_name</label>
          <input type="text" name="first_name" value="<?php echo $rows['first_name']; ?>"><br><br>

          <label for="last_name">last_name</label>
          <input type="text" name="last_name" value="<?php echo $rows['last_name']; ?>"><br><br>

          <label for="email">email</label>
          <input type="email" name="email" value="<?php echo $rows['email']; ?>"><br><br>

          <label for="phone">phone</label>
          <input type="number" name="phone" value="<?php echo $rows['phone']; ?>"> <br><br>        

          <input type="submit" name="editProfile" value="Edit">
        </form>

    </div>
   </div>           
     
   </div>
        
        
  </div>  
    
</div>
        
 <?php }} else { ?>
<div class="error"> 
              <h3>Errors</h3>
              <p>you must Log in firstly</p>
</div>              

<?php } ?>         
         
  <script src="layout/js/jquery.min.js"></script>
  <script src="layout/js/jquery-ui.min.js"></script>
  <script src="layout/js/custom.js"></script>
    

</body>
</html>