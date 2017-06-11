<?php 

require_once "user.php";

class Admin extends users
{
	
	
public function addcategory($cat_name,$parent, $level){
	
		$query="INSERT INTO category(cat_name, parent_id, level) VALUES(:cat_name, :parent, :level)";
		$stmt=$this->Create_pdo_conn()->prepare($query);
		$stmt->bindparam(":cat_name",$cat_name);
		$stmt->bindparam(":parent",$parent);
		$stmt->bindparam(":level", $level);
		$result = $stmt->execute();
		if($result)
			return true;
		else{
			return false;
		}
}

	function addproduct($cat_id, $name,$desc,$number,$price, $folder ){
			
		$pic=$this->storeImage($folder);

		$picname=$pic;
		$query="INSERT INTO product(cat_id, pro_name,pro_desc,avail_quantity,price,pic_name) VALUES(:cat_id ,:proname,:descr,:available,:price,:picname)";
		$stmt=$this->Create_pdo_conn()->prepare($query);
		$stmt->bindparam(":cat_id",$cat_id);
		$stmt->bindparam(":proname",$name);
		$stmt->bindparam(":descr",$desc);
		$stmt->bindparam(":available",$number);
		$stmt->bindparam(":price",$price);
		$stmt->bindparam(":picname",$picname);
		$result = $stmt->execute();

		if($result){

			return 1;
		}else {
			return 0;
		}
	
}

	// Function to Select Category
	function selectcats(){
				
		$query="SELECT cat_id,cat_name from category";
		$stmt=$this->Create_pdo_conn()->prepare($query);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}

	public function selectProduct(){

		$query="SELECT * from product";
		$stmt=$this->Create_pdo_conn()->prepare($query);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}

	// Function to Select Users
	public function selectusers($user){
				
		$query="SELECT * from users WHERE user_name = '{$user}'";
		$stmt=$this->Create_pdo_conn()->prepare($query);
		$stmt->execute();
		$rows=$stmt->fetch(PDO::FETCH_ASSOC);
		return $rows;
	}


public function updateCateg($cat_id, $cat_name){

	$query=" UPDATE category set cat_name=? WHERE cat_id = {$cat_id}";

	$stmt = $this->Create_pdo_conn()->prepare($query);
	$rows = $stmt->execute(array($cat_name));
	 
	 if($rows)
	  	return true;
	 
	 else 
	  	return false;
}

public function updateProduct($pro_id, $pro_name, $price, $available, $pro_desc){

	$query=" UPDATE product set pro_name=?, price=?, avail_quantity=?, pro_desc=? WHERE pro_id = {$pro_id}";
	$stmt = $this->Create_pdo_conn()->prepare($query);
	$rows = $stmt->execute(array($pro_name, $price, $available, $pro_desc));
	 
	 if($rows)
	  	return true;
	 
	 else 
	  	return false;
}


	public function selectFromProduct( $pro_id){

		$query = "SELECT price FROM product WHERE pro_id = $pro_id";
		$stmt = $this->Create_pdo_conn()->prepare($query);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return $result;
	}


	public function selectZeroLevel(){
	
		$query = "SELECT * FROM category WHERE level = 0";
		$stmt = $this->Create_pdo_conn()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public function selectFirstLevel(){
	
		$query = "SELECT * FROM category WHERE level = 1";
		$stmt = $this->Create_pdo_conn()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public function selectChildCategory($parent){
		$query = "SELECT * FROM category WHERE parent_id = {$parent}";
		$stmt = $this->Create_pdo_conn()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public function addOffer($pro_id, $offer){

		$query=" UPDATE product SET offer=? WHERE pro_id = {$pro_id} ";
		$stmt = $this->Create_pdo_conn()->prepare($query);
		$rows = $stmt->execute(array($offer));
		 
		 if($rows)
		  	return true;
		 
		 else 
		  	return false;

	}




}
