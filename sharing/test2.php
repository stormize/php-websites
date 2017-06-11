<?php
session_start();
require_once'connection.php';
print_r($_POST);
$user_id=$_GET['id'];
$query="select * from friends where user_id=:user_id and user_id_friend=:friend_id and state='request' ";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_SESSION['user_id']);
$stmt->bindParam(':friend_id',$_GET['id']);
$stmt->execute();

$no=$stmt->rowCount();
echo $no;
if($no==0){

echo'<form action="" method="post">
<button type="submit" name="add_friend"> add friend</button>
</form>';
}
if(isset($_POST['add_friend'])){

$query="insert into friends(user_id,user_id_friend,user_name) values (:user_id,:friend_id,:user_name)";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_SESSION['user_id']);
$stmt->bindParam(':friend_id',$_GET['userid']);
$stmt->bindParam(':user_name',$user_name);

$stmt->execute();
header("Refresh:0");
}



?>