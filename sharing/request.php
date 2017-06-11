<?php
require'connection.php';
class request{
public function __construct()
{

}
public function add_friend($user_id,$friend_id){
	$query="insert into friends(user_id,user_id_friend) values
(:user_id,:friend_id)";
$stmt=$GLOBALS['db']->prepare($query);
$stmt->bindParam(':user_id',$user_id);
$stmt->bindParam(':friend_id',$friend_id);

$stmt->execute();
}


public function get_request($requesting_id){

$query="select * from friends where user_id_friend=:friend_id and state='request'";
$stmt=$GLOBALS['db']->prepare($query);
$stmt->bindParam(':friend_id',$requesting_id);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
echo'<button>ddddddd</button>';

}

}

?>