<?php  
	
require_once 'user.php';


class Customers extends users
{

/*-------------------*
 -> After Inheritance we can Access to function [$this->Create_pdo_conn()] 
 	to Return Varibale connection it's we used with Function [ prepare() ]
 	As [ $conn->prepare($query); ]

*------------------*/
	
	// Thsi Function to Verify Registration just for Clients no Admin
	 public function Register_User($details){

		$query = "INSERT INTO users SET first_name=?, last_name=?, user_name=?, password=?, national_id=?, pic_name=?, email=?, phone=?";
    	$stmt = $this->Create_pdo_conn()->prepare($query);
    	$result = $stmt->execute(array($details[0], $details[1], $details[2], $details[3], $details[4], $details[5], $details[6], $details[7]));
    	return $result;
    }


	public function Select_Customers($username){

				$query="SELECT * from users WHERE user_name=:username";
                $stmt= $this->Create_pdo_conn()->prepare($query);
                $stmt->bindparam(":username",$username);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
	}	

    public function selectCommentUser($user_id){
            $query="SELECT user_name, pic_name from users WHERE user_id={$user_id}";
            $stmt= $this->Create_pdo_conn()->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
    }

    public function insertComment($user_id, $comment, $pro_id){
        $query = "INSERT INTO comment SET content=?, user_id=?, pro_id=?";
        $stmt = $this->Create_pdo_conn()->prepare($query);
        $result = $stmt->execute(array($comment, $user_id, $pro_id));
        return $result;
    }

        public function updateCustomer($user_id, $details){

        $query = "UPDATE users SET first_name=?, last_name=?, email=?, phone=? WHERE user_id = {$user_id}";
        $stmt= $this->Create_pdo_conn()->prepare($query);
        $result = $stmt->execute(array($details[0], $details[1], $details[2], $details[3]));
        return $result;

    }
}

