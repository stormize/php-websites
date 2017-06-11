<?php
require_once'connection.php';
class profile{
public function __construct(){


}

public function get_user($user_id){

$query="select * from users where user_id=:user_id ";
$stmt=$GLOBALS['db']->prepare($query);
$stmt->bindParam(':user_id',$user_id);
$stmt->execute();
$rows=$stmt->fetch(PDO::FETCH_ASSOC);
return $rows;
}

public function user_friends($user_id){
$query="SELECT * from friends where (user_id=:user_id or user_id_friend=:user_id) and state='accepted' ";
$stmt=$GLOBALS['db']->prepare($query);
$stmt->bindParam(':user_id',$user_id);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
}



 public function username($friend){
    $query="SELECT user_name,user_id from users where user_name like '%$friend%'";
    $stmt=$GLOBALS['db']->prepare($query);
  
    if(!$stmt->execute()){
                print_r($stmt->errorInfo());
               }
    $row=$stmt->fetchAll(PDO::FETCH_ASSOC);           
    
                       
                        return $row;
                
            }

}
?>