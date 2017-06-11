<?php
require_once'connection.php';
session_start();

?>
<?php
if(!$_SESSION['user_name']){
	echo"<form action='' method='post'>
<input type='text'  name='username'	placeholder='username'>
<input type='text' 	name='password'	placeholder='password'>
<input type='submit' name='submit' value='login'>
</form>";
}else{
	echo "<form action='' method='post'>";
	echo '<input type="submit" value="logout" name="logout">
	</form>';

$query3="select * from friends where user_id_friend='".$_SESSION['user_id']."'";
$stmt3=$db->prepare($query3);
if($stmt3->execute()){
$rows=$stmt3->fetchALL(PDO::FETCH_ASSOC);


}
foreach($rows as $row){
echo'<form action ="" method="post">
'.$row['user_name'].'
<button type="submit" value="'.$row['user_id'].'">ACCEPT</button></br></br>
</form>
';


}
}
if(isset($_POST['logout'])){

session_destroy();
header("LOCATION:test.php");

}



if(isset($_POST['submit'])){
$username=$_POST['username'];
$password=$_POST['password'];

$query='select * from users where user_name=:username
and password=:password';
$stmt=$db->prepare($query);
$stmt->bindParam(':username',$username);
$stmt->bindParam(':password',$password);
if($stmt->execute()){

$row=$stmt->fetch(PDO::FETCH_ASSOC);
echo $row['user_name'];
$_SESSION['user_name']=$row['user_name'];
$_SESSION['user_id']=$row['user_id'];
header("Refresh:0");

}
}

if($_SESSION['user_name']){
$query='select * from users';
$stmt=$db->prepare($query);
$stmt->execute();
$rows=$stmt->fetchALL(PDO::FETCH_ASSOC);



foreach($rows as $row){

	echo '<a href="test.php?get_user='.$row['user_name'].'&user_id='.$row['user_id'].'" >'.$row['user_name'].'  </a></br>';
}
if(isset($_GET['get_user'])){

header("LOCATION:test2.php?user=".$_GET['user_id']."");
}

/*
if(isset($_GET['add_user'])){

$id=$_SESSION['user_id'];
$id_friend=$_GET['user_id'];
echo $id_friend;
$query2="insert into friends
(user_id,user_name,user_id_friend) 

values
(:id,:username,:id_friend)

";
$stmt2=$db->prepare($query2);
$stmt2->bindParam(':username',$_SESSION['user_name']);
$stmt2->bindParam(':id',$id);
$stmt2->bindParam('id_friend',$id_friend);
if($stmt2->execute()){
	echo'done';
	header("LOCATION:test.php");

}
*/
}

?>