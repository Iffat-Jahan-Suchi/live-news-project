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
                $query = "SELECT post.post_id, post.title,post.post_img,categories.category_name,post.post_date,users.username FROM post LEFT JOIN categories ON post.category=categories.category_id LEFT JOIN users ON post.author=users.user_id" ;
                $result = mysqli_query($con,$query);
                $count = mysqli_num_rows($result);
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
                        $date = $row['post_date'];
                        $author = $row['username'];
                        $img = $row['post_img'];
                        $SI++

                        ?>
                        <tr>
                            <td class='id'> <?php echo $SI++ ?></td>
                            <td><img src="upload/<?php echo $img?>" height="50px" width="50px" class="center-block" alt=""></td>
                            <td><?php echo $title?></td>
                            <td><?php echo $category?></td>
                            <td><?php echo $date?></td>
                            <td><?php echo $author?></td>
                            <td class='edit'><a href=''><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><i class='fa fa-trash-o'></i></a></td>
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
