
<?php

include 'profile.php';
include "bigclass.php";
$poo= new users();
$pics=$poo->myimages($_SESSION["user_id"]);
$obj=new profile;
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
        <li><a href="mypics.php">mypics</a></li>
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
</div>
</div>
</nav>
<!-- End Navbar -->

<div class="content">

<div class="my_friends">
<h3 >My friends</h3>
	<ul>
		<?php
		if(isset($_SESSION['user_id'])){
		
        $rows=$obj->user_friends($_SESSION['user_id']);
      
        foreach($rows as $row){
    
     
        $name=$poo->getnames($row['user_id_friend']);
       if($_SESSION['user_id']!==$row['user_id_friend'])
       
        echo' <input type="hidden" name="userid" value="'.$row['user_id'].'">
      <a href="user_page.php?id='.$row['user_id_friend'].'" class="btn btn-primary">'.$name[0]['user_name'].'</a>';
        }      
        }
		?>
	</ul>
</div>
<div class="form">

  <form action="" method="post">
    	<label>find friends:</label>
    	<input type="text" name="search" class="form-control" placeholder="Search About Friends">
    	<input type="submit" class="btn btn-primary" name="srch">
	</form>
	
  <ul>
<?php
        if(isset($_SESSION['user_id'])){
        
        if(isset($_POST['srch'])){
        $result=$obj->username($_POST['search']); 
?>
<form class="get" method="get" action="user_page.php">
  <fieldset>
    <legend>Search Result:</legend>
<?php        
    foreach ($result as $one) {
        if($_SESSION['user_id']!==$one['user_id']){
        echo'	<input type="hidden" name="userid" value="'.$one['user_id'].'">
      <a href="user_page.php?id='.$one['user_id'].'" class="btn btn-primary">'.$one['user_name'].'</a>';
    }}
?>
  </fieldset>
</form>
<?php 
    }
    }

?>
    </ul>
</div>

<!-- Footer -->
</div>

    <footer>
        <div class="container">
             <div class="well well-lg">
                 <div class="copy text-center">
                     <p>Powerd By @ <span>NULL TEAM</span></p>
                 </div>
             </div>
        </div>
    </footer>
