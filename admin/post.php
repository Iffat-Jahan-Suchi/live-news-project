<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <?php
                $SI=0;
                require 'config.php';
                if ($_SESSION['user_role'] == '1') {
                    $query = "SELECT post.post_id, post.title,post.post_img,post.category,categories.category_name,post.post_date,users.username FROM post LEFT JOIN categories ON post.category=categories.category_id LEFT JOIN users ON post.author=users.user_id ORDER BY post.post_id DESC" ;
                }
                elseif ($_SESSION['user_role'] == '0')
                {
                    $query = "SELECT post.post_id, post.title,post.post_img,categories.category_name,post.post_date,users.username FROM post LEFT JOIN categories ON post.category=categories.category_id LEFT JOIN users ON post.author=users.user_id WHERE post.author={$_SESSION['user_id']} ORDER BY post.post_id DESC";
                }


                $result = mysqli_query($con,$query);
                $count = mysqli_num_rows($result);
                $SiCount=0;
                if ($count > 0) {

                ?>
                <table class="content-table">
                    <thead>
                    <th>S.No.</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </thead>
                    <tbody>

                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['post_id'];
                        $title = $row['title'];
                        $category = $row['category_name'];
                        $categoryID = $row['category'];
                        $date = $row['post_date'];
                        $author = $row['username'];
                        $img = $row['post_img'];
                        $SiCount++


                        ?>
                        <tr>
                            <td> <?php echo $SiCount?></td>
                            <td><img src="upload/<?php echo $img?>" height="50px" width="50px" class="center-block" alt=""></td>
                            <td><?php echo $title?></td>
                            <td><?php echo $category?></td>
                            <td><?php echo $date?></td>
                            <td><?php echo $author?></td>
                            <td class='edit'><a href='update-post.php?id=<?php echo $id?>'><i class='fa fa-edit'></i></a></td>
                            <td><a href="delete-post.php?id=<?php echo $id?>&catId=<?php echo $categoryID?>"onclick="return confirm('Are you sure to delete this...')" class="fa fa-trash"></a></td>
                        </tr>
                        <?php
                    }

                    ?>
                    </tbody>


                    <?php
                    }
                    ?>
                </table>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
