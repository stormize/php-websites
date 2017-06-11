<?php 
      session_start();
      require_once "classes/admin.php";
      
      $admin = new Admin();

    if(isset($_COOKIE['Remember_User'])){
    $admin->Session('username', $_COOKIE['Remember_User']);
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
          <script src="layout/js/jquery.min.js"></script>

      <script src="layout/js/jquery.validate.min.js"></script>
        <script src="layout/js/script.js"></script> <!-- Externa Js File file - My File -->

</head>
    <body>
<?php include "layout/header.php"; 

  if(isset($_SESSION['username'])){ 

      $role = $admin->selectusers($_SESSION['username']);
    if($role['role'] == 1){

?>


<div class="header">
    <div class="navbar"> 
      <div class="container">
         <div class="logo">
            <h3>Profile Details</h3>
             </div>
      </div>
    </div>     
</div>


<section class="users">
  
<div class="details">
  
  <h4>Ahmed</h4>
  <h4>Ahmed</h4>
  <h4>Ahmed</h4>
  <h4>Ahmed</h4>
  <h4>Ahmed</h4>

</div>

</section>





 
 <?php }else{ ?>

<div class="error"> 
              <h3>Errors</h3>
              <p>Sorry you ar not Admin</p>
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