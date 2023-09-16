<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    $SI = 0;
                    $limit = 3;
                    if(isset($_GET['page'])){
                        $page_number = $_GET['page'];
                    }else{
                        $page_number = 1;
                    }
                    $offset = ($page_number - 1) * $limit;
                    require 'admin/config.php';
                    $query = "SELECT post.post_id,post.description, post.title,post.post_img,post.category,categories.category_name,post.post_date,users.username FROM post LEFT JOIN categories ON post.category=categories.category_id LEFT JOIN users ON post.author=users.user_id ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                    $result = mysqli_query($con, $query);
                    $count = mysqli_num_rows($result);
                    $SiCount = 0;
                    if ($count > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['post_id'];
                            $title = $row['title'];
                            $category = $row['category_name'];
                            $categoryID = $row['category'];
                            $date = $row['post_date'];
                            $author = $row['username'];
                            $description = $row['description'];
                            $img = $row['post_img'];
                            $SiCount++;
                            ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $id;?>"><img src='admin/upload/<?php echo $img?>' alt=""/></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $id;?>'><?php echo $title?></a></h3>
                                            <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php'><?php echo $category?></a>
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
                                            <p class="description">
                                             <?php echo substr($description,0,150).'...'?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $id;?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                        ?>
                     <?php
                    }else{
                        echo "no record";
                    }


                    $query2 = "SELECT * FROM post";
                    $result2 = mysqli_query($con,$query2) or dir("Failed.");
                    if(mysqli_num_rows($result2)){
                        $total_records = mysqli_num_rows($result2);
                        $total_page = ceil($total_records/$limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if($page_number > 1){
                            echo '<li><a href="index.php?page='.($page_number-1).'">prev</a></li>';
                        }

                        for($i = 1; $i <= $total_page; $i++){

                            if($i == $page_number){
                                $active = "active";
                            }else{
                                $active = "";
                            }

                            echo '<li class='.$active.'><a href="index.php?page='.$i.'">'.$i.'</a></li>';
                        }
                        if($total_page > $page_number){
                            echo '<li><a href="index.php?page='.($page_number+1).'">next</a></li>';
                        }
                        echo "</ul>";
                    }
                    ?>


                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
