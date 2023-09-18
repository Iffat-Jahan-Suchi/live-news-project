<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        require 'admin/config.php';
        $query="SELECT post.post_id,post.category,post.title,post.description,post.post_date,post.post_img,categories.category_name FROM POST LEFT JOIN categories ON post.category=categories.category_id LEFT JOIN users ON post.author=users.user_id ORDER BY post.post_id DESC ";
        $result=mysqli_query($con,$query);
        $count=mysqli_num_rows($result);
        if($count>0)
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                ?>
                <div class="recent-post">
                    <a class="post-img" href="">
                        <img src="admin/upload/<?php echo $row['post_img']?>" alt=""/>
                    </a>
                    <div class="post-content">
                        <h5><a href="single.php?id=<?php echo $row['post_id'] ?>"><?php echo $row['title']?></a></h5>
                        <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name']?></a>
                </span>
                        <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                   <?php echo $row['post_date']?>
                </span>
                        <a class="read-more" href="single.php?id=<?php echo $row['post_id'] ?>">read more</a>
                    </div>
                </div>

        <?php
            }

        }else{
            echo "no record";
        }
        ?>
        <div class="recent-post">
            <a class="post-img" href="">
                <img src="images/post-format.jpg" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php">Web Development</a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php'>Html</a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    19 July, 2020
                </span>
                <a class="read-more" href="single.php">read more</a>
            </div>
        </div>
    </div>
    <!-- /recent posts box -->
</div>
