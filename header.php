<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News Site</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <?php
                    require 'admin/config.php';
                    if(isset($_GET['cid'])){
                        $cate_id = $_GET['cid'];
                    }

                    $query = "SELECT * FROM categories WHERE post>0";
                    $result = mysqli_query($con, $query);
                    $count = mysqli_num_rows($result);
                    $SiCount=0;
                    if ($count > 0) {
                        ?>
                <ul class='menu'>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat_Id=$row['category_id'];
                        $cat_name=$row['category_name'];
                        $post_name=$row['post'];
                        $SiCount++;
                        $active='';
                        if(isset($_GET['cid'])){
                            if($cat_Id == $cate_id){
                                $active = 'active';
                            }else{
                                $active = '';
                            }
                        }
                    ?>
                    <?php
                        echo "<li><a class='$active' href='category.php?cid=$cat_Id'>$cat_name</a></li>";
                        ?>
                    <?php
                    }
                    ?>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
