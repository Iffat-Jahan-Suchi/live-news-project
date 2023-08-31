<?php 

include 'config.php';
$deleteId=$_GET['id'];
$query="DELETE FROM users WHERE user_id={$deleteId}";
$result=mysqli_query($con,$query);
if($result)
{
    header('location:users.php');
}
else
{
    echo "no data deleted";
}
mysqli_close($con);

?>