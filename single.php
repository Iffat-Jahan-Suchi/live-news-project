<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <?php
                  if(isset($_GET['id']))
                  {
                      $postId=$_GET['id'];
                  }
                    require 'admin/config.php';
                    $query = "SELECT post.post_id,post.description,post.author,post.title,post.post_img,post.category,categories.category_name,post.post_date,users.username FROM post LEFT JOIN categories ON post.category=categories.category_id LEFT JOIN users ON post.author=users.user_id WHERE post.post_id='{$postId}'";
                    $result = mysqli_query($con, $query);
                    $count = mysqli_num_rows($result);

                    $SiCount = 0;
                    if ($count > 0)
                    {
                    while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row['title'];
                    $category = $row['category_name'];
                    $categoryID = $row['category'];
                    $date = $row['post_date'];
                    $author = $row['username'];
                    $description = $row['description'];
                    $img = $row['post_img'];
                    $SiCount++;
                    ?>
                    <?php
                    }
                    ?>
                    <?php
                    }
                    else{
                        echo "no record data";
                    }
                    ?>
                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $title?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                     <a href='category.php?cid=<?php echo $categoryID;?>'><?php echo $category?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php'><?php echo $author?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $date?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $img?>" height="300px" width="400px" alt=""/>
                            <p class="description">
                                <?php echo $description?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
