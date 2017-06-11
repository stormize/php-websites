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
        ?>
      </ul>
     </div><!-- /.navbar-collapse -->
</nav>

      <!-- Modal -->
<div class="modal fade" id="signin" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sign In</h4>
        </div>
          <form action="user.php" method="post">
        <div class="modal-body">
          
            <div class="input-group">
						  <p>User Name: <br/><input type="text" autocomplete="off" class="form-control" name="username" placeholder="Username" aria-describedby="basic-addon1"></p>
					  </div>

					  <div class="input-group">
						  <p>Password: <br/><input type="password" autocomplete="off" class="form-control" name="password" placeholder="password" aria-describedby="basic-addon1"></p>
					  </div>

					  <div class="input-group">
					    <p><input type="checkbox" name="remember" value="yes" aria-label="..."> Remember Me</p>
					  </div>
					  <!-- /input-group -->

					  <a href="#">forget password</a>
            
        </div>
        <div class="modal-footer">
			        <input type="submit" name="sign_in" value="Sign In" class="btn btn-primary">
			      </div>
              
              </form>
                  
</div>
      </div>
</div>
<!-- Sign In Modal -->
        
<!-- sign Up Modal -->
        
<div class="modal fade" id="register" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Sign Up</h4>
		      </div>
		      <form id="myform" class="cmxform" action="user.php" method="post"  enctype="multipart/form-data" >
		      <div class="modal-body">
			    <div class="input-group">
			    	<label for="firstname">First Name:</label>
					 <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="basic-addon1" required>
				</div>

				<div class="input-group">
					<label for="lastname">Last Name:</label>
						<input type="text" class="form-control" id="lastname" name="lastname"aria-describedby="basic-addon1" required>
					</div>

				<div class="input-group">
					<label for="username">User name:</label>
						<input type="text" class="form-control" id="username" name="username" aria-describedby="basic-addon1" required>
					</div>

				<div class="input-group">
					<label for="password">Password:</label>
						<input type="password" class="form-control" id="password" name="password" aria-describedby="basic-addon1" required>
					</div>

				

				<div class="input-group">
					<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" aria-describedby="basic-addon1" required>
					</div>

				<div class="input-group">
						<label for="image">Upload Image:</label>
						<input type="file" class="img" name="image" aria-describedby="basic-addon1" >
					</div>

		      </div>
		      <div class="modal-footer">
		        <input type="submit" name="sign_up" value="Sign Up" class="btn btn-primary">
		      </div>
		      </form>

        </div>
              </div>
</div>
        
<!-- End Sign up Maodal -->
    
    <!-- Start Slider -->
		
	<div id="myslider" class="carousel slide" data-ride="carousel">
	
		<!-- Indicators -->
		<ol class="carousel-indicators hidden-xs">
		  <li data-target="#myslider" data-slide-to="0" class="active"></li>
		  <li data-target="#myslider" data-slide-to="1"></li>
		  <li data-target="#myslider" data-slide-to="2"></li>
		  <li data-target="#myslider" data-slide-to="3"></li>
		</ol>

				<div class="carousel-inner" role="listbox">
										
				  <div class="item active">
					<img src="img/first-image.JPG" alt="Slide-first">
				  </div>
				  
				  <div class="item">
					<img src="img/second-image.jpg" alt="Slide-second">
					<div class="carousel-caption">
						<p class="mission lead hidden-sm hidden-xs ">When Technology becomes absolute passion </p>
					</div>
				  </div>
				  
				  <div class="item">
					<img src="img/third-image.jpg" alt="Slide-third">
				  </div>
				  
				  <div class="item">
					<img src="img/four-image.jpg" alt="Slide-fourth">
				  </div>
				  
				</div>
			  
				<!-- Controls -->
				<a class="left carousel-control hidden-xs " href="#myslider" role="button" data-slide="prev">
				  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				  <span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control hidden-xs " href="#myslider" role="button" data-slide="next">
				  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				  <span class="sr-only">Next</span>
				</a>
				
			  </div>
		
		<!-- End Slider -->
		
<!-- start Show Images -->

<div class="show-images">
    <div class="bj-image">
    <div class="container">
        <div class="row">
<?php
if(isset($_SESSION['logged_on'])){
	
foreach ($pics as $key => $value) {
	$name=$poo->getnames($pics[$i]['user_id']);
?>
            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-3 dis-img">
            <h3 class="text-center"><?php echo $name[$j]['user_name'];  ?> added photo</h3>
                <img src="pictures/<?php echo $pics[$i++]['pic_name'] ?>" class="img-thumbnail img-responsive" alt="Cinque Terre" width="304" height="236">
            </div>

  <?php
}
}
?>          
        </div>
        </div>
    </div>
</div>
  
<!-- End Show Images -->

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