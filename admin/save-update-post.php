<?php
require 'config.php';
if (isset($_REQUEST['submit'])) {
    $errors = array();
    $old_img = $_POST['old_image'];
    $new_img = $_FILES['new_image'];
    $edit_id = $_POST['post_id'];
    $fileName = $new_img['name'];
    $tmpName = $new_img['tmp_name'];
    $file_size = $new_img['size'];
    $file_type = $new_img['type'];
    $tmp = explode('.',$fileName);
    $file_extension = end($tmp);
    $extensions = array("jpeg","jpg","png");

    if(in_array($file_extension,$extensions) === false)
    {
        $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
    }
    if($file_size > 2097152){
        $errors[] = "File size must be 2mb or lower.";
    }
    if ($fileName) {
        if (file_exists('upload/' . $old_img)) {
            unlink('upload/'.$old_img);
        }
        $new_name = time(). "-".basename($fileName);
        $target = "upload/".$new_name;
        $fileName = $new_name;
        if(empty($errors) == true){
            move_uploaded_file($tmpName,$target);
        }else{
            print_r($errors);
            die();
        }


    } else {
        $fileName = $old_img;
    }


    $query = "UPDATE post SET 
        title='{$_POST["post_title"]}',
        description='{$_POST["postdesc"]}',
        category={$_POST["category"]},
        post_img='{$fileName}' 
        WHERE post_id={$_POST["post_id"]}; ";



    if($_POST['old_category'] != $_POST["category"] ){
        $query .= "UPDATE categories SET post= post - 1 WHERE category_id = {$_POST['old_category']};";
        $query .= "UPDATE categories SET post= post + 1 WHERE category_id = {$_POST["category"]};";
    }

    $result = mysqli_multi_query($con,$query);

    if($result){
        header("location: ../admin/post.php");
    }else{
        echo "Query Failed";
    }
    $result = mysqli_multi_query($con,$query);

    if($result)
    {
        header("location:post.php");
    }
    else{
        echo "not updated";
    }

}
?>