<?php
session_start();
class users
{

   private $dbhost = 'mysql:host=localhost; dbname=pictures';
   private $user = 'root';
   private $dbpass = '';
   private $option = array(
            PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES UTF8',
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        );

  private $_passed = false,
            $_error = array(),
            $_db = null;

    // To Create Connection
    public function __construct()
    {
        try{   
                $this->_pdo = new PDO($this->dbhost, $this->user, $this->dbpass, $this->option);
        } 
        catch(PDOException $e) {
                die($e->getMessage());
        }
    } 

    // We Calling this function in case Inheritance To Run Constructor to Create Connection DB
    public function Create_pdo_conn(){
        return $this->_pdo;
    }

    // This Function to Check whether this USER exists or NO
    public function login($username,$password){

      $query="SELECT user_name, password,user_id from users WHERE user_name=:username AND password=:password";
                $stmt= $this->_pdo->prepare($query);
                $stmt->bindparam(":username",$username);
                $stmt->bindparam(":password",$password);
                $stmt->execute();
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user_id']=$row['user_id'];
                if($row)
                       
                        return 1;
                elseif (!$row) 
                        return 0;
    }

    // This Function To Return Role this Person to check if his Admin or User
    public function Permission($username){

        $query="SELECT * from users WHERE user_name=:username";
                $stmt= $this->_pdo->prepare($query);
                $stmt->bindparam(":username",$username);
                $stmt->execute();
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                $role = $row['role'];
                if($role == 1)
                        return 1;
                else 
                    return 0;
}
                public function register($username,$password,$firstname,$lastname,$email,$picname,$picdir){
                  
                   
               
                    $query="INSERT INTO users(user_name,password,f_name,l_name,email,pic_name,user_pic) VALUES (:username,:password,:firstname,:lastname,:email,:imagename,:imagedir)";
                    $stmt=$this->_pdo->prepare($query);
                    $stmt->bindparam(":username",$username);
                    $stmt->bindparam(":password",$password);
                    $stmt->bindparam(":firstname",$firstname);
                    $stmt->bindparam(":lastname",$lastname);
                    $stmt->bindparam(":email",$email);
                    $stmt->bindparam(":imagename",$picname);
                    $stmt->bindparam(":imagedir",$picdir);
               if(!$stmt->execute()){
                print_r($stmt->errorInfo());
               }


                }
      public function storeImage($path,$name,$size,$type,$error){
           
     $dir_name =dirname(__FILE__)."/pictures/";
if(!$error&&is_uploaded_file($path)&&in_array($type, array('image/png','image/gif','image/jpeg','image/jpg','mage/pjpeg','image/x-png','image/png'))&&$size <2000000000000000000000000000){
    move_uploaded_file($path, $dir_name.$name);
    $result['path']=$path;
    $result['name']=$name;


    return $result;


}
elseif($size<2000000000000000000000000000){
  echo"<a href='mypics.php''>back</a> <br>";
die("the picture is very big");
}
else{
    echo "error in uploading file".$error;
    return 0;
}
    }
    
    public function friends($userid){
        $query="SELECT user_id_friend from friends where user_id=:userid";
         $stmt= $this->_pdo->prepare($query);
         $stmt->bindparam(":userid",$userid);
          if(!$stmt->execute()){
                print_r($stmt->errorInfo());
               }
         $rows=$stmt->fetchall(PDO::FETCH_ASSOC);
        
      foreach ($rows as $row) {
          $rows[$i]=$this->getnames($row[$i++]['user_id_friend']);
      }

    
       //return $rows[];

    }
    
    function userid($username){
     $query ="SELECT user_id from users where user_name=:username";
      $stmt= $this->_pdo->prepare($query);
      $stmt->bindparam(":username",$username);
      $stmt->execute();
      $row=$stmt->fetchall(PDO::FETCH_ASSOC);
        
         return $row;
    }
    public function getnames($ids){
       $query="SELECT user_name from users where user_id=:ids";
         $stmt= $this->_pdo->prepare($query);
         $stmt->bindparam(":ids",$ids);
         $stmt->execute();
         $row=$stmt->fetchall(PDO::FETCH_ASSOC);
        
         return $row;
    }
    function username($friend){
    $query="SELECT user_name,user_id from users where user_name like '%$friend%'";
    $stmt=$this->_pdo->prepare($query);
  
    if(!$stmt->execute()){
                print_r($stmt->errorInfo());
               }
    $row=$stmt->fetchall(PDO::FETCH_ASSOC);           
    
                       
                        return $row;
                
            }
    function getinfo($userid){
        $query="SELECT f_name,l_name,email,pic_name from users where user_id=:userid";
         $stmt=$this->_pdo->prepare($query);
         $stmt->bindparam(":userid",$userid);
         if(!$stmt->execute()){
                print_r($stmt->errorInfo());
               }
               $row=$stmt->fetchall(PDO::FETCH_ASSOC);           
    
                       
                        return $row;
    }
    function insertimage($userid,$picname,$picdir){
       
        $query="INSERT into photos(user_id,picture,pic_name) VALUES(:userid,:picdir,:picname)";
        $stmt=$this->_pdo->prepare($query);
        $stmt->bindparam(":userid",$userid);
        $stmt->bindparam("picdir",$picdir);
        $stmt->bindparam("picname",$picname);
        $stmt->execute();
               
    }
    function myimages($userid){
     $query="SELECT pic_name,picture from photos where user_id=:userid ORDER BY pic_id DESC";
      $stmt=$this->_pdo->prepare($query);
      $stmt->bindparam(":userid",$userid);
      if(!$stmt->execute()){
                print_r($stmt->errorInfo());
               }

 $row=$stmt->fetchall(PDO::FETCH_ASSOC);           
    
                       
                        return $row;
    }
    function friendspics($userid){
        $query="SELECT pic_name,picture,user_id from photos where user_id IN (SELECT user_id_friend from friends where user_id=:userid )
         ORDER BY pic_id DESC
        ";
        $stmt=$this->_pdo->prepare($query);
        $stmt->bindparam(":userid",$userid);
        if(!$stmt->execute()){
                print_r($stmt->errorInfo());
               }
               $row=$stmt->fetchall(PDO::FETCH_ASSOC); 
               return $row;
    }
public function check($source, $items = array())
    {
        foreach($items as $item=>$rules){
            foreach ($rules as $rule => $rule_value) {
                $value = trim($source[$item]);
                $item = htmlentities($item, ENT_QUOTES, 'UTF-8');

                if($rule === 'required' && empty($value)){
                    $this->addError("{$item} is Required");
                }
                else if(!empty($value)){
                    switch ($rule) {

                        case 'sanitize_string':
                            if(filter_var($value, FILTER_SANITIZE_STRING) === false){
                                $this->addError("{$item} Not valid Text");
                            }
                            break;
                        case 'sanitize_number':
                            if(filter_var($value, FILTER_SANITIZE_NUMBER_INT) === false){
                                $this->addError("{$item} Not valid Number");
                            }
                            break;

                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("{$item} must be a minimum of {$rule_value} Characters");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} must be a maximum of {$rule_value} Characters");
                            }
                            break;
                        case 'exact':
                            if(strlen($value) !== $rule_value){
                                $this->addError("{$item} must be Equal {$rule_value} Characters");
                            }
                            break;
                        case 'matches':
                            if($value !== $source[$rule_value]){
                                $this->addError("{$rule_value} must be match {$item}");
                            }
                            break;

                        case 'valid_email':
                            if(filter_var($value, FILTER_VALIDATE_EMAIL) === false){
                                $this->addError("{$item} Not valid Email");
                            }
                            break;
                    }
                } 
            }
        }

        if(empty($this->_error)){
            $this->_passed = true;
        }

        return $this;
    
    }// end fumction



    private function addError($error){
        $this->_error[] = $error;
    }

    public function errors(){
        return $this->_error;
    }

    public function passed(){
        return $this->_passed;
    }
    function  add($userid,$friendid,$username){

        $query="insert into friends(user_id,user_id_friend,user_name) values (:user_id,:friend_id,:user_name)";
$stmt=$this->_pdo->prepare($query);
$stmt->bindParam(':user_id',$userid);
$stmt->bindParam(':friend_id',$friendid);
$stmt->bindParam(':user_name',$username);

$stmt->execute();

 $query="insert into friends(user_id,user_name,user_id_friend) values (:user_id,:friend_id,:user_name)";
$stmt->bindParam(':user_id',$userid);
$stmt->bindParam(':friend_id',$friendid);
$stmt->bindParam(':user_name',$username);

$stmt->execute();




header("Refresh:0");
    }
    function img($id){

    


 $query="SELECT pic_name,user_pic from users where user_id=:userid";
      $stmt=$this->_pdo->prepare($query);
      $stmt->bindparam(":userid",$id);
      if(!$stmt->execute()){
                print_r($stmt->errorInfo());
               }

 $row=$stmt->fetchall(PDO::FETCH_ASSOC);           
    
                       
                        return $row;

        }
  function checks($user_id,$id){
  $query="SELECT user_id,user_id_friend FROM friends where user_id=:user_id and user_id_friend=:id or (user_id=:id and user_id_friend=:user_id) ";
$stmt=$this->_pdo->prepare($query);
$stmt->bindParam(':user_id',$user_id);
$stmt->bindParam(':id',$id);

$stmt->execute();
$row=$stmt->fetchall(PDO::FETCH_ASSOC);
if(!$row)
  return 0;
else
  return 1;
}
      }


