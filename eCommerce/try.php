<?php
include'../connect_DB_PDO.php';
print_r($_POST);

function addcategory($cat_name,$desc,$price){

	$query="INSERT INTO category(cat_name,Description) VALUES(:catname,:descr)";
	$stmt=$conn->prepare($query);
	$stmt->bindparam(":catname",$cat_name);
	$stmt->bindparam(":descr",$desc);
	if(!$stmt->execute()){
		print_r($stmt->errorInfo());
	}
}


function addproduct($name,$desc,$number,$price){
		$pic=pichandle();
		$picname=$pic['path'];
		$picdir=$pic['dir_name'];
		print_r($pic);
		$query="INSERT INTO product(pro_name,Description,avail_quantity,price,pic_name,pic_dir) VALUES(:proname,:descr,:available,:price,:picname,:picdir)";
		$stmt=$conn->prepare($query);
		$stmt->bindparam(":proname",$name);
		$stmt->bindparam(":descr",$desc);
		$stmt->bindparam(":available",$number);
		$stmt->bindparam(":price",$price);
		$stmt->bindparam(":picname",$picname);
		$stmt->bindparam(":picdir",$picdir);
		if(!$stmt->execute()){
				print_r($stmt->errorInfo());
			}
}

function selectcats(){
			
	$query="SELECT cat_name from category WHERE 1";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$rows=$stmt->fetch(PDO::FETCH_ASSOC);
	return $rows;
}

function pichandle(){
$dir_name = dirname(__FILE__) . "/users_image/";  // Specefied Folder to Store Image in it
  $path = $_FILES['pic']['tmp_name'];        //temporary path
  $name = $_FILES['pic']['name'];           // Get File Name
  $size = $_FILES['pic']['size'];          // Get File Size
  $type = $_FILES['pic']['type'];         //Get File Type
  $error = $_FILES['pic']['error'];       // If Error

  if (!$error && is_uploaded_file($path) && in_array($type, array('image/png', 'image/gif', 'image/jpeg', 'image/jpg', 'mage/pjpeg', 'image/x-png', 'image/png')) && $size < 2000000000000000) {

      move_uploaded_file($path, $dir_name . $name);
  } else {
      echo 'error in upload file ' . $error;
  }
  $result['path']=$path;
  $result['dir_name' ]=$dir_name . $name;
  print_r($result);
  return $result;
  

}

?>