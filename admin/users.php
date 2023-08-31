<?php include "header.php";


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
                $query = "SELECT * FROM users ORDER BY user_id DESC ";
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

                        <td><?php echo $SiCount?></td>
                        <td><?php echo $userId?></td>
                        <td><?php echo $first_name.' '.$last_name?></td>
                       <!-- <td><?php /*echo $password*/?></td>-->
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
                        <td><a href="" class="fa fa-edit"></a></td>
                        <td><a href="" class="fa fa-trash"></a></td>

                    </tr>
                    <?php } ?>
                    </tbody>
                    <?PHP
                }
                ?>
                </table>


            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
