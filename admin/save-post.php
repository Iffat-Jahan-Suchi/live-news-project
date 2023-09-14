<?php
  include "config.php";
  if(isset($_FILES['fileToUpload']))
  {
    $error=[];
    $fileName=$_FILES['fileToUpload']['name'];
    $fileSize=$_FILES['fileToUpload']['size'];
    $tmp_name=$_FILES['fileToUpload']['tmp_name'];
    $fileType=$_FILES['fileToUpload']['type'];
    $file_ext=end(explode('.',$fileName));
    $extention=['jpg','png','jpeg'];
    if(in_array($file_ext,$extention)===false)
    {
      $error[]="The extension file is not allowed,please upload jpg or png file";
    }
    if($fileSize>2097152)
    {
      $error[]="FIle size too large.must be 2 mb or lower";
    }
    $new_name=time()."-".basename($fileName);
    $target='upload/'.$new_name;
    if(empty($error)==true)
    {
      move_uploaded_file($tmp_name,$target);
    }else
    {
      print_r('error');
    }
  }
session_start();

$title=mysqli_real_escape_string($con,$_POST['post_title']);
$description=mysqli_real_escape_string($con,$_POST['postdesc']);
$category=mysqli_real_escape_string($con,$_POST['category']);
$date=date('d-M-Y');
$author=$_SESSION['user_id'];
$insert="INSERT INTO post(title,description,category,post_date,author,post_img)VALUES('{$title}','{$description}','{$category}'
,'{$date}','{$author}','{$new_name}');";
$insert.="UPDATE categories SET post=post+1 WHERE category_id={$category}";
if(mysqli_multi_query($con,$insert))
{
  header('location:post.php');
}else{
  echo "not insert";
}
?>
