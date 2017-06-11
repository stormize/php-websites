<?php
session_start();
require'connection.php';
$query=" select * from friends where user_id_friend=:user_id and state='request'";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_SESSION['user_id']);
if($stmt->execute()){
$result=$stmt->fetchALL(PDO::FETCH_ASSOC);
foreach($result as $row){
echo'<form action="" method="post">';
	echo $row['user_name'].'<button type="submit" value="'.$row['user_id'].'" name="accept"> accept</button> 
	<button type="submit" value="'.$row['user_id'].'" name="reject"> reject</button>
	<input type="hidden" name="hidden" value="'.$row['user_id_friend'].'"
	</br></br></form>';
}
if(isset($_POST['accept'])){

$user_id=$_POST['accept'];
$query="update friends set state='accepted' where user_id=:user_id and user_id_friend=:friend_id";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_POST['accept']);
$stmt->bindParam(':friend_id',$_POST['hidden']);
$stmt->execute();
}
if(isset($_POST['reject'])){
$query="update friends set state='rejected' where user_id=:user_id and user_id_friend=:friend_id";
$stmt=$db->prepare($query);
$stmt->bindParam(':user_id',$_POST['reject']);
$stmt->bindParam(':friend_id',$_POST['hidden']);
$stmt->execute();}
}

?>