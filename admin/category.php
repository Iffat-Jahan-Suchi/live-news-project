<?php include "header.php";

if(!isset($_SESSION['user_role'])=='1')
{
    header("location:post.php");
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php
                require 'config.php';
                $limit=3;
                if(isset($_GET['page'])){
                    $page_number = $_GET['page'];
                }else{
                    $page_number = 1;
                }

                $offset = ($page_number - 1) * $limit;
                $query = "SELECT * FROM categories ORDER BY category_id DESC";
                $result = mysqli_query($con, $query);
                $count = mysqli_num_rows($result);
                $SiCount=0;
                if ($count > 0) {
                ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    $cat_Id=$row['category_id'];
                    $cat_name=$row['category_name'];
                    $post_name=$row['post'];
                    $SiCount++


                    ?>
                        <tr>
                            <td class='id'><?php echo $SiCount ?></td>
                            <td><center><?php echo $cat_name?></center></td>
                            <td><center><?php echo $post_name?></center></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo  $cat_Id?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a onclick="return confirm('Are you sure to delete this...?')" href='delete-category.php?id=<?php echo  $cat_Id?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                    <?php } ?>

                    </tbody>
                    <?Php
                    }
                    ?>
                </table>
                <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
