<?php 
	require_once "/../classes/customer.php";
	require_once "/../classes/admin.php";
	require_once "/../classes/products.php";


	$product = new products();
	$admin = new Admin();

?>


<!--***********************************
							Sidebar SECTION
				************************************-->

<div class="ui left vertical menu sidebar">
	<div class="ui styled fluid accordion">
<?php 
	$category = $admin->selectZeroLevel();
	foreach ($category as $value) {
?>							  	
	  	<div class="title">
	    	<i class="dropdown icon"></i>
	    	<?php echo $value['cat_name'].$value['cat_id']; ?>
	  	</div>
	<div class="content">

<?php
	$child = $admin->selectChildCategory($value['cat_id']); 
 foreach ($child as $key) {
 ?>
			<div class="title">
				<i class="dropdown icon"></i>
				<?php echo $key['cat_name']; ?>
			</div>

<?php } ?>
	</div>

<?php } ?>

	</div>
</div>

<div class="pusher">
				<!--***********************************
							MODALS SECTION
				************************************-->

<div id="modals">
	<!-- ***********************
			Sign In Modal
	************************ -->
	<div id="sign-in-modals">
		<div class="ui modal small sign-in-modal">
		  <div class="header">Sign In</div>
		  <div class="content">
		    <form action="register.php" method="POST">
		    	<input type="text" name="username" placeholder="User name">
		    	<input type="password" name="password" placeholder="Password">
				<p><input type="checkbox" name="remeber" value="yes">Remmember me</p><br>
				<input type="submit" class="ui approve button " name="login" value="Login">
		    </form>
		  </div>
		</div>
	</div>

	<!-- ***********************
			Start Sign UP Modal
	************************ -->
	<div id="sign-up-modals">
		<div class="ui modal small sign-up-modal">
		  <div class="header">Sign Up</div>
		  <div class="content">
		    <form id="myform" action="register.php" method="POST" enctype="multipart/form-data" autocomplete="off">
				
				<label for="first_name"></label>
				<input type="text" id="first_name" name="first_name" placeholder="First name *">
		    	
				<label for="last_name"></label>
		    	<input type="text" id="last_name" name="last_name" placeholder="Last name *">
		    	
				<label for="user_name"></label>
		    	<input type="text" id="user_name" name="user_name" placeholder="User name *">
		    	
		    	<label for="password"></label>	
		    	<input type="password" id="password" name="password" placeholder="Password *">
				<label for="confirm_password"></label>
				<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password *">
				
				<label for="email"></label>
				<input type="text" id="email" name="email" placeholder="Email *"><br><br>
				
				<label for="national_id"></label>
				<input type="number" id="national_id" name="national_id" placeholder="National ID *">
				
				<label for="phone"></label>
				<input type="text" name="phone" placeholder="Phone *"><br><br>
				
				<input type="file" name="image"><br> <br>

		    	<input type="submit" class="ui approve button " name="register" value="Register">
		  
			</form>
		</div>
		</div>
	</div>
	<!-- ***********************
			End Sign UP Modal
	************************ -->
</div>


<!--***********************************
			NAVBAR SECTION
************************************-->
<nav id="navbar">

		<!--***********************************
					TOP NAV
		************************************-->
	<div id="top-nav">
		<div class="container">

			<div class="float-left"id="top-nav-left">
			<ul>
				<?php 
				if(isset($_SESSION['username'])){
				$customer = new Customers();
				$rows = $customer->Select_Customers($_SESSION['username']);

				if($rows){
				?>

				<li><a href=""><span>Phone: </span><?php echo $rows['phone']; ?></a></li>
				<li><a href=""><span>E-mail: </span><?php echo $rows['email']; ?></a></li>
				
				<?php if($rows['role'] == 1) {?>
				<li>Welcome<a href="admin-panel.php"> <?php echo $rows['user_name']; ?></a></li>
				
				<?php } else if($rows['role'] == 0){ ?>	
				<li>Welcome<a href="user-profile.php"> <?php echo $rows['user_name']; ?></a></li>
				
				<?php }}}
				elseif (isset($_COOKIE['Remember_User'])) {
					
					$customer = new Customers();
					$rows = $customer->Select_Customers($_COOKIE['Remember_User']);

				if($rows){
				?>

				<li><a href=""><span>Phone: </span><?php echo $rows['phone']; ?></a></li>
				<li><a href=""><span>E-mail: </span><?php echo $rows['email']; ?></a></li>
				
				<?php if($rows['role'] == 1) { ?>
				<li>Welcome<a href="admin-panel.php"> <?php echo $rows['user_name']; ?></a></li>
				
				<?php } else if($rows['role'] == 0){ ?>	
				<li>Welcome<a href="user-profile.php"> <?php echo $rows['user_name']; ?></a></li>
				

				<?php }}}
				 ?>
			</ul>
			</div>

			<div class="float-right" id="top-nav-right">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="contact.php">Contact Us</a></li>
					<li>
						<select>
							<option value="eng">EU</option>
							<option value="ara">Ar</option>
						</select>
					</li>
				</ul>
			</div>

		</div> <!-- CONTAINER END -->
		</div> <!-- TOP NAV END -->

		<!--***********************************
					BOTTOM NAV
		************************************-->
	<div id="bottom-nav">
		<div class="container">

			<!--***********************************
						LOGO SECTION
			************************************-->

			<div id="logo" class="float-left">
				<a href="index.php"><img src="layout/img/logo3.png" alt="Logo"></a>
			</div>

			<!--***********************************
					NVBAR CONTENT SECTION
			************************************-->

			<div id="nav-content" class="float-left">

					<div id="nav-regester" class="float-left">
						<ul>
							<?php //print_r($_COOKIE['Remember_User']); ?>
				<?php if(!isset($_COOKIE['Remember_User'])){

						if(!isset($_SESSION['username'])){
				 ?>
							<li><a href="#" id="signin-modal">Log In</a></li>
							<li>|</li>
							<li><a href="#" id="regest-modal">Register</a></li>
							
				<?php   } else { ?>
							<li><a href="logout.php">Logout</a></li>
						<?php 	} 
						} 
						else { ?>
								  
							<li><a href="logout.php">Logout</a></li>
							
							<?php } ?>
						</ul>
					</div>

					<div id="search-input" class="float-left">
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<input type="text" name="search_value" placeholder="Search..">
						<input type="submit" name="search" value="Search">
					</form>
					</div>

					<div id="nav-card" class="float-left">
						<a href="shoping.php"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a>
					</div>

					<div id="categ-menu">
						<a href="#" id="category-menu"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
					</div>

			</div>

		</div> <!-- CONTAINER END -->
	</div><!-- NAVBAR BOTTOM END -->

</nav><!-- NAVBAR END -->
			</div>


