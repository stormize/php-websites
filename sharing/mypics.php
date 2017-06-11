<?php

include "bigclass.php";
$poo= new users();
$pics=$poo->myimages($_SESSION["user_id"]);

$i=0;
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
            
        <title>Share Your Image</title>
        <!-- Compatibility with Internet Explorer -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Meta For Mobile -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        
        <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="respond.min.js"></script>
        <![endif]-->
</head>

<body>
    
    <nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">Home</a></li>
        <li><a href="friends.php">Friends</a></li>
        <li><a href="not.php">friend requests</a></li>
        <?php
         if(!isset($_SESSION['logged_on'])){
            echo '
        <li><a href="#" data-toggle="modal" data-target="#signin">Login</a></li>
        <li><a href="#" data-toggle="modal" data-target="#register">Register</a></li>
        ';

    }
    else{
echo '<li><a href="log out.php"  >Sign out</a></li>';
    }
        ?>
      </ul>
     </div><!-- /.navbar-collapse -->
   </div>
   </nav>



<div class="insert">
    <form class="form" method="post" action="user.php" enctype="multipart/form-data">
  <input name ="image" type="file">
<br>
<input type="submit" class="btn btn-primary" name="insertpic">
</form>
</div>
    
<?php
foreach ($pics as $key => $value) {
?>
<div class="container">
<div class="pic_img">
  <img src="pictures/<?php echo $pics[$i++]['pic_name'] ?>" class="img-rounded img-responsive" alt="..."/>
</div>
</div>
     
  <?php
}
?>

     

<!-- Footer -->
    <footer>
        <div class="container">
             <div class="well well-lg">
                 <div class="copy text-center">
                     <p>Powerd By @ <span>NULL TEAM</span></p>
                 </div>
             </div>
        </div>
    </footer>
