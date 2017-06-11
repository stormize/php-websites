<?php  

require_once 'user.php';

class Validate extends users {

	private $_passed = false,
			$_error = array(),
			$_db = null;

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
			 			case 'unique':
			 				if($this->Check_Customers($value)){
			 					$this->addError("Sorry username {$item} is Exist");
			 				}

			 		}
			 	} 
			}
		}

		if(empty($this->_error)){
			$this->_passed = true;
		}

		return $this;
	
	}// end fumction


	private function Check_Customers($username){

                $query="SELECT user_name from users WHERE user_name=:username";
                $stmt= $this->Create_pdo_conn()->prepare($query);
                $stmt->bindparam(":username",$username);
                $stmt->execute();
                $row = $stmt->rowCount();
                return $row;
    }   


	private function addError($error){
		$this->_error[] = $error;
	}

	public function errors(){
		return $this->_error;
	}

	public function passed(){
		return $this->_passed;
	}

// end class
}