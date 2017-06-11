<link rel="stylesheet" type="text/css" href="layout/css/style.css">

<?php 
 include "classes/user.php";
 include "classes/customer.php";
 require_once 'classes/validation.php';
 require_once "classes/admin.php";


// Create Object from Admin Class to use it in Whole File
   $admin = new Admin();
  $customer = new Customers();



session_start();


if(isset($_POST['register'])){
    $validate = new Validate();
    $validtion = $validate->check($_POST, array(

      'first_name' => array(
          'required' => true,
          'sanitize_string' => 'first_name',
          'min' => 2,
        ),
      'last_name' => array(
          'required' => true,
          'sanitize_string' => 'last_name',
          'min' => 2,
        ),
      'user_name' => array(
          'required' => true,
          'unique' => 'user_name',
          'sanitize_string' => 'user_name',
          'min' => 2,
          'max' => 10
        ),
      'password' => array(
          'required' => true,
          'min' => 4,
          'max' => 16
        ),
      'confirm_password' => array(
          'required' => true,
          'matches' => 'password'
        ),
      'national_id' => array(
          'required' => true,
          'exact' => 14,
          'sanitize_number' => 'national_id'
        ),
      'email' => array(
          'required' => true,
          'valid_email' => 'email'
        ),
      'phone' => array(
          'required' => true,
          'min' => 10,
          'max' => 14
        )

      ));

    if($validtion->passed()){

      // After Valid Inputs we can POST Data from  Form and Insert it to DB
      $firstName = $_POST['first_name'];
      $firstName = trim($firstName);

      $lastName = $_POST['last_name'];
      $lastName = trim($lastName);

      $userName = $_POST['user_name'];
      $userName = trim($userName);
      
      $password = $_POST['password'];
      $hash_pass = sha1($password);
      
      $email = $_POST['email'];
      $national_id = $_POST['national_id'];
      $phone = $_POST['phone'];


// Store Image throw Function storeImage in Class Customers
      $picture = $customer->storeImage('users_image');



// Now Verify Registertion
  $result = $customer->Register_User(array($firstName, $lastName, $userName, $hash_pass, $national_id, $picture, $email, $phone));

  if($result){          
      
      $customer->Session('username', $userName);
      header("Location:index.php");

  }
  else {
    echo "Failure";
  }

  }
    else{
?>      
        <div class="error"> 
              <h3>Errors</h3>
              <p>
<?php    
          foreach($validate->errors() as $errors){
           echo $errors. '<br>';
          }
?>
              </p>
        </div> 
<?php
header("refresh:2; url=index.php");
    }

}

/*-------End of registration ------*/


// Code Login
if(isset($_POST['login'])){

	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $password = sha1($password);

		$user = new users();
		$result = $user->login($username, $password);
		if($result){

          if(isset($_POST['remeber'])){
            $user->Cookies('Remember_User', $username, time()+86400);
            $user->Cookies('Remember_Password', $password, time()+86400);
            $user->Session('username', $username); // function to create Session
          } else
          {
              $user->Session('username', $username); // function to create Session
          }
          header("Location:index.php");
    }  
  else{
        echo "<div class='error'><h3>"."Sorry Username/password Incorrect" .
        "<p>Redirecting Into Home Page in 3 Seconds</p>".
         "</h3></div>";
        header("refresh:3; url=index.php");
  }
}


// Insert Category

if(isset($_POST['addCategory'])){


  if(isset($_POST['zero_parent'])){
    $parent = $_POST['zero_parent'];
    $level = 1;
  }else if(isset($_POST['first_parent'])){
    $parent = $_POST['first_parent'];
    $level = 2;
  }else{
    $parent = NULL;
    $level = 0;
  }


  $result = $admin->addcategory($_POST['cat_name'], $parent, $level);
    if($result)
    header("Location:admin-panel.php");
  else 
    echo "Error";
}



// Insert Products

if(isset($_POST['add_Product'])){

  // $admin == Object from Admin Class
  $result = $admin->addproduct($_POST['category'], $_POST['title'], $_POST['description'], $_POST['number'], $_POST['price'], 'product_image');

  if($result)
    header("Location:admin-panel.php");
  else {
    echo " error";
  }

}


// Update Category 

if(isset($_POST['Edit_Category'])){

  $result = $admin->updateCateg($_POST['category_id'], $_POST['cat_title']);

  if($result)
    header("Location:admin-panel.php");
  else {
    echo " error";
  }

}


// Update Product

if(isset($_POST['Edit_Product'])){

  $result = $admin->updateProduct($_POST['pro_id'], $_POST['pro_title'], $_POST['price'], $_POST['avail'], $_POST['pro_des']);
  if($result)
    header("Location:admin-panel.php");
  else {
    echo " error";
  }

}

// Add Offer

if(isset($_POST['addOffer'])){

     $pro_id = $_POST['pro_id'];
     $offer = $_POST['offer'];    // 30%

    $result = $admin->selectFromProduct($pro_id);  // 3000
    $math_op = $result['price'] / 100;  // 3000/100 = 30


    $calc = $offer * $math_op;  // 30 * 30 = 900 == 30%

    $result = $admin->addOffer($pro_id, $calc);

    if($result)
    header("Location:admin-panel.php");
    else
        echo "Not Offer";

}


// Edit Offer

if(isset($_POST['editOffer'])){

     $pro_id = $_POST['pro_id'];
     $offer = $_POST['offer'];    // 30%

    $result = $admin->selectFromProduct($pro_id);  // 3000
    $math_op = $result['price'] / 100;  // 3000/100 = 30


    $calc = $offer * $math_op;  // 30 * 30 = 900 == 30%

    $result = $admin->addOffer($pro_id, $calc);

    if($result)
    header("Location:admin-panel.php");
    else
        echo "Not Offer";

}


// Edit Profile User

if(isset($_POST['editProfile'])){

  $user_id = $_POST['user_id'];
  $user_name = $_POST['user_name'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];


  $result = $customer->updateCustomer($user_id, array($first_name, $last_name, $email, $phone));
  if($result){
      $role = $admin->selectusers($user_name);
      if($role['role'] == 1)
        header("Location:admin-panel.php");
      else if($role['role'] == 0)
        header("Location:user-profile.php");

  }
    
  else
    echo "Error happend";
}


?>