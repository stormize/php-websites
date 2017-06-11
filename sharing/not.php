<?php
include "request.php";
$obj=new request;

include "bigclass.php";
$poo= new users();
if(isset($_SESSION['logged_on'])){
$pics=$poo->friendspics($_SESSION['user_id']);

$i=0;
$j=0;
}?>
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
        
        <?php
         if(!isset($_SESSION['logged_on'])){
         	echo '
        <li><a href="#" data-toggle="modal" data-target="#signin">Login</a></li>
        <li><a href="#" data-toggle="modal" data-target="#register">Register</a></li>
        ';

    }
    else{

 echo'
		<li><a href="friends.php">Friends</a></li>
        <li><a href="mypics.php">my pics</a></li>
		<li><a href="log out.php"  >Sign out</a></li>
		<li><a href="not.php">friend requests</a></li>
	';
}
if($rows=$obj->get_request($_SESSION['user_id'])){
	
?>
      		</ul>
       </div><!-- /.navbar-collapse -->
	</div>
</nav>
      <!-- Modal -->


        

          <!-- Modal content-->
      
<!-- End Sign up Maodal -->
      

<!-- End Navbar -->
    
    <!-- Start Slider -->
		
	
		
		<!-- End Slider -->
		
<!-- start Show Images -->

<!-- End Show Images -->
<?php
foreach($rows as $row){
	if($_SESSION['user_id']!==$row['user_id']){
		
	$names=$poo->getnames($row['user_id']);
echo'<form class="form" action="" method="post">';
	echo "<h4>".$names[0]['user_name']."</h4>".'<button class="btn btn-primary" type="submit" value="'.$row['user_id'].'" name="accept"> accept</button> 
	<button type="submit" class="btn btn-primary" value="'.$row['user_id'].'" name="reject"> reject</button>
	<input type="hidden" name="hidden" value="'.$row['user_id_friend'].'"
	</br></br></form>';
}}

}




    if(isset($_POST['accept'])){

$user_id=$_POST['accept'];
$query="update friends set state='accepted' where user_id=:user_id and user_id_friend=:friend_id";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_POST['accept']);
$stmt->bindParam(':friend_id',$_POST['hidden']);
$stmt->execute();
$query="update friends set state='accepted' where user_id=:user_id and user_id_friend=:friend_id";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_POST['hidden']);
$stmt->bindParam(':friend_id',$_POST['accept']);
$stmt->execute();
header("Refresh:0");

}
if(isset($_POST['reject'])){
$query="update friends set state='rejected' where user_id=:user_id and user_id_friend=:friend_id";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_POST['hidden']);
$stmt->bindParam(':friend_id',$_POST['reject']);
$stmt->execute();
header("Refresh:0");

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

<!-- End Footer -->

    
    

        <script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/wow.min.js"></script>
		<script> new WOW().init(); </script>
		<script src="js/custom.js"></script>    
    
</body>
    
</html>