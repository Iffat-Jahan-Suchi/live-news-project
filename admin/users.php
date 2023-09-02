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
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
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
                $query = "SELECT * FROM users ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                $result = mysqli_query($con, $query);
                $count = mysqli_num_rows($result);
                $SiCount=0;
                if ($count > 0) {
                    ?>
                    <table class="table table-warning"

                    <thead>
                    <tr>
                        <th scope="col">SI No</th>
                        <th scope="col">DB ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>


                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $userId=$row['user_id'];
                        $first_name=$row['first_name'];
                        $last_name=$row['last_name'];
                        $userName=$row['username'];
                        $password=$row['password'];
                        $role=$row['role'];
                        $SiCount++


                    ?>
                    <tr>

                        <td><?php echo $SiCount+$offset?></td>
                        <td><?php echo $userId?></td>
                        <td><?php echo $first_name.' '.$last_name?></td>
                        <td><?php echo $userName?></td>
                        <td>
                            <?php
                            if($role==1)
                            {
                                echo 'Admin';
                            }
                            else{
                                echo "Moderator";
                            }


                            ?>

                        </td>
                        <td><a href="update-user.php?userId=<?php echo $userId?>" class="fa fa-edit"></a></td>
                        <td><a href="delete-user.php?id=<?php echo $userId?>"onclick="return confirm('Are you sure to delete this...')" class="fa fa-trash"></a></td>

                    </tr>
                    <?php } ?>
                    </tbody>
                    <?Php
                }
                ?>
                </table>


             <!--       <li><a href="" class="active">2</a></li>
                    <li><a href="" class="active">3</a></li>-->


                <?php
                include 'config.php';
                $paginationQuery="SELECT * FROM users";
                $result1=mysqli_query($con,$paginationQuery);
                if((mysqli_num_rows($result1))>0)
                {
                    $total_records = mysqli_num_rows($result1);
                    $total_page = ceil($total_records/$limit);

                    echo "<ul class='pagination admin-pagination'>";
                    if($page_number > 1){
                        echo '<li><a href="users.php?page='.($page_number-1).'">prev</a></li>';
                    }
                    for($i=1; $i<=$total_page; $i++)
                    {
                        if($i == $page_number){
                            $active = "active";
                        }else{
                            $active = "";
                        }

                        echo '<li class='.$active.'><a class="" href="users.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if($total_page > $page_number){
                        echo '<li><a href="users.php?page='.($page_number+1).'">next</a></li>';
                    }
                    echo "</ul>";
                }




                ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
