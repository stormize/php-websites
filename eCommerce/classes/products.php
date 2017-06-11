<?php

require_once "user.php";

class products extends users {
    //put your code here
    
     public function selectProducts(){
        
        $query="SELECT * from product";
        $stmt=$this->Create_pdo_conn()->prepare($query);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function searchProducts($value){
        
        $query="SELECT * from product WHERE pro_name LIKE '%{$value}%'";
        $stmt=$this->Create_pdo_conn()->prepare($query);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function selectCurrentItem($id){

    	$query="SELECT * from product WHERE pro_id = {$id}";
        $stmt=$this->Create_pdo_conn()->prepare($query);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function selectCurrentCategory($id){

    	$query="SELECT * from category WHERE cat_id = {$id}";
        $stmt=$this->Create_pdo_conn()->prepare($query);
        $stmt->execute();
        $rows=$stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function insertOrder($user_id, $pro_id, $avail_quantity, $total_price){
        $query = "INSERT INTO orders SET user_id = ?, pro_id=?, avail_quantity=?, total_price=?";
        $stmt = $this->Create_pdo_conn()->prepare($query);
        $result = $stmt->execute(array($user_id, $pro_id, $avail_quantity, $total_price));
        return $result;

    }

    public function selectOrders($user_id){
        $query="SELECT * from orders WHERE user_id = {$user_id}";
        $stmt=$this->Create_pdo_conn()->prepare($query);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function selectOrdersNumbers($user_id){
        $query="SELECT * from orders WHERE user_id = {$user_id}";
        $stmt=$this->Create_pdo_conn()->prepare($query);
        $stmt->execute();
        $rows=$stmt->rowCount();
        return $rows;
    }

    public function selectSlider(){
        $query="SELECT * from product ORDER BY pro_id DESC LIMIT 5";
        $stmt=$this->Create_pdo_conn()->prepare($query);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;

    }

    public function selectComments($id){
        $query="SELECT * from comment WHERE pro_id= {$id}";
        $stmt=$this->Create_pdo_conn()->prepare($query);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }


    public function checkOffer($pro_id){
        $query="SELECT offer from product WHERE pro_id = {$pro_id}";
        $stmt=$this->Create_pdo_conn()->prepare($query);
        $stmt->execute();
        $rows=$stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }
}


