<?php 

class users
{

    private $_pdo;
    private $dbhost = 'mysql:host=localhost;dbname=electronics';
    private $dbuser = 'id1647423_amr';
    private $dbpass = 'Amr0106288';
    private $option = array(
                PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        );

    // To Create Connection
    public function __construct()
    {
        try{   
                $this->_pdo = new PDO($this->dbhost, $this->dbuser, $this->dbpass, $this->option);
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

    	$query="SELECT user_name, password from users WHERE user_name=:username AND password=:password";
                $stmt= $this->_pdo->prepare($query);
                $stmt->bindparam(":username",$username);
                $stmt->bindparam(":password",$password);
                $stmt->execute();
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                if($row)
                        // We Calling this function in case Inheritance To Run Constructor to Create Connection DB
                        return 1;
                elseif (!$row) 
                        return 0;
    }

// Store image
    function storeImage($folder){

          $dir_name = dirname(__DIR__) ."/$folder/";  // Specefied Folder to Store Image in it
          $path = $_FILES['image']['tmp_name'];        //temporary path
          $name = $_FILES['image']['name'];           // Get File Name
          $size = $_FILES['image']['size'];          // Get File Size
          $type = $_FILES['image']['type'];         //Get File Type
          $error = $_FILES['image']['error'];       // If Error

          if (!$error && is_uploaded_file($path) && in_array($type, array('image/png', 'image/gif', 'image/jpeg', 'image/jpg', 'mage/pjpeg', 'image/x-png', 'image/png')) && $size < 200000) {

              move_uploaded_file($path, $dir_name . $name);
              return $name;
          } else {
              return $error;
          }
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

    // This Function To Create Session only
    public function Session($name, $value){

            $_SESSION[$name] = $value;
    }


    // ThisFunction To Create Cookies
    public function Cookies($name, $value, $expiry){

            setcookie($name, $value, $expiry);
    }

}
