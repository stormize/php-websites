<!DOCTYPE HTML>
<html>
    
<head>
    <title>Errors</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

<?php

include "bigclass.php";
$user= new users();
if(isset($_POST['sign_up'])){
    $valid=$user->check($_POST,array(
    'username'=> array(
'required'=>true,
'sanitize_string'=>'username',
'min'=>2,

    	),

 'password'=> array(
'required'=>true,

'min'=>2,
'max'=>16,

    	),
  'firstname'=> array(
'required'=>true,
'sanitize_string'=>'firstname',
'min'=>2,

    	),

 'lastname'=> array(
'required'=>true,
'sanitize_string'=>'lastname',
'min'=>2,

    	),
 'email'=> array(
'required'=>true,
'valid_email'=>'email'

    	),




    	));
    if($valid->passed()){
    
$result=$user->storeimage($_FILES['image']['tmp_name'],$_FILES['image']['name'],$_FILES['image']['size'],$_FILES['image']['type'],$_FILES['image']['error']);
$user->register($_POST['username'],$_POST['password'],$_POST['firstname'],$_POST['lastname'],$_POST['email'],$result['name'],$result['path']);
header('Location: index.php');

    }

else{
	
?>      
        <div class="error"> 
              <h3>Errors</h3>
              <p>
<?php    
          foreach($user->errors() as $errors){
           echo $errors. '<br>';
          }
?>
              </p>
        </div> 
<?php
header("refresh:3; url=index.php");
    
}
	
}


 if(isset($_POST['sign_in'])){

if($user->login($_POST['username'],$_POST['password'])){
	$_SESSION['logged_on']=1;
	header('Location: index.php');
}
else{
    echo "<div class='error'>".
            "<h3>Errors</h3>".
        "<p> Sorry Username/Password Incorrect</p>".
        "</div>"
    ;
	header('refresh:3; url=index.php');
 }}

 if(isset($_POST['insertpic'])){

 	$result=$user->storeimage($_FILES['image']['tmp_name'],$_FILES['image']['name'],$_FILES['image']['size'],$_FILES['image']['type'],$_FILES['image']['error']);
 	$user->insertimage($_SESSION['user_id'],$result['name'],$result['path']);
 header("refresh:0; url=mypics.php");
 }
 
?>

</body>
</html>