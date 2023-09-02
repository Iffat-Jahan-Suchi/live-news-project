<?php 

include 'config.php';

if($_SESSION['user_role'] == '0'){
  header("location: post.php");
}

$rcv_id = $_GET['id'];

$query = "DELETE FROM categories WHERE category_id = '{$rcv_id}'";

$result = mysqli_query($con,$query);

if($result){
	header("location: category.php");
}else{
	echo "Can't Delete Category.";
}

mysqli_close($con);

?>