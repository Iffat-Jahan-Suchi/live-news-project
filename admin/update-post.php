<?php include "header.php";

if ($_SESSION['user_role'] == '0') {
    header("location: post.php");
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <?php
                include 'config.php';
                $id=$_GET['id'];
                   $query = "SELECT post.post_id,post.title,post.post_img,post.category,categories.category_name,post.post_date,post.description,users.username FROM post LEFT JOIN categories ON post.category=categories.category_id LEFT JOIN users ON post.author=users.user_id WHERE post.post_id={$id}";
                   $result=mysqli_query($con,$query);
                   $count=mysqli_num_rows($result);
                   if($count>0)
                   {
                       while ($row=mysqli_fetch_assoc($result))
                       {
                           $id = $row['post_id'];
                           $title = $row['title'];
                           $category = $row['category_name'];
                           echo $category_id = $row['category'];
                           $date = $row['post_date'];
                           $author = $row['username'];
                           $img = $row['post_img'];
                           $description =$row['description'];


                ?>
                <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="post_id" class="form-control" value="<?php echo $id ?>"
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTile">Title</label>
                        <input type="text" name="post_title" class="form-control" id="exampleInputUsername"
                               value="<?php echo $title ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" required rows="">
                    <?php echo $description ?>
                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <select name="category" class="form-control">
                            <option disabled selected> Select Category</option>
                            <?php
                            include 'config.php';
                            $query1 = "SELECT * FROM categories";
                            $result1 = mysqli_query($con, $query1);
                            if (mysqli_num_rows($result1) > 0) {
                                while ($row1=mysqli_fetch_assoc($result1))
                                {
                                    if($row['category'] == $row1['category_id'])
                                        {
                                            $selected="selected";
                                        }
                                    else{
                                        $selected=" ";
                                    }

                                    $id=$row1['category_id'];
                                    $name=$row1['category_name'];
                                    echo " <option {$selected} value=$id>$name</option>";
                                }

                            }
                            ?>
                        </select>

                        <input type="hidden" name="old_category" value="<?php echo $category_id ?>">

                    </div>
                    <div class="form-group">
                        <label for="">Post image</label>
                        <input type="file" name="new_image">
                        <img src="upload/<?php echo $img ?>" height="150px">
                        <input type="hidden" name="old_image" value="<?php echo $row['post_img']; ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update"/>
                </form>
                <?php
                       }
                   }else{
                       echo "no data found";
                   }
                ?>


                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
