<?php
require "profile.php";
$obj=new profile;
include "bigclass.php";
$poo= new users();
$info=$poo->img($_GET['id']);

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
        <li><a href="#">Contact</a></li>
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
  </nav>

<div class="user_page">

<div class="text-xs-center">
  <div class="span">
  <img src="pictures/<?php echo $info[0]['pic_name'] ?>" class="img-rounded img-responsive" alt="filed" >
  </div>    

      <?php 
      

$user=$_GET['id'];

$row=$obj->get_user($user);

echo "<h3 class='text-center'>".$row['user_name'].'</h3>';
echo "<h3 class='text-center'>".$row['email'].'</h3>';


$user_id=$_GET['id'];
$query="select * from friends where user_id=:user_id and user_id_friend=:friend_id and state='request' ";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_SESSION['user_id']);
$stmt->bindParam(':friend_id',$_GET['id']);
$stmt->execute();

$no=$stmt->rowCount();
if($no==0){
if(!$poo->checks($_SESSION['user_id'],$_GET['id'])){
echo'<form class="form" action="" method="post">';
echo'<button type="submit" class="btn btn-primary" name="add_friend" value="">add friend<button>';
echo '</form>';}
}else{

  echo'your request is sent';
}

if(isset($_POST['add_friend'])){
$query="insert into friends(user_id,user_id_friend) values (:user_id,:friend_id)";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_SESSION['user_id']);
$stmt->bindParam(':friend_id',$_GET['id']);

$stmt->execute();
$query="insert into friends(user_id_friend,user_id) values (:user_id,:friend_id)";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_SESSION['user_id']);
$stmt->bindParam(':friend_id',$_GET['id']);

$stmt->execute();
header("Refresh:0");

}



?>
</div>



</div>

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

</body>
</html>