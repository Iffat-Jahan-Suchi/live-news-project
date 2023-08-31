<?php include "header.php";?>

<?php
if(isset($_POST['submit']))
{
    require 'config.php';
    $userId = mysqli_real_escape_string($con, $_POST['user_id']);
    $fname = mysqli_real_escape_string($con, $_POST['f_name']);
    $lname = mysqli_real_escape_string($con, $_POST['l_name']);
    $user = mysqli_real_escape_string($con, $_POST['username']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    require 'config.php';
    $query="UPDATE users SET first_name='{$fname}',last_name='{$lname}',username='{$user}',role='{$role}'WHERE users.user_id={$userId}";
    $result=mysqli_query($con,$query);
    if($result)
    {
        header("location:users.php");
    }else{
        echo "not updated";
    }
}


?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                $id=$_GET['userId'];
                require 'config.php';
                $query="SELECT * FROM users WHERE user_id={$id}";
                $result=mysqli_query($con,$query);
                $count=mysqli_num_rows($result);
                if($count>0)
                {
                    while ($row=mysqli_fetch_assoc($result))
                    {

                        $userId=$row['user_id'];
                        $first_name=$row['first_name'];
                        $last_name=$row['last_name'];
                        $userName=$row['username'];
                        $password=$row['password'];
                        $role=$row['role'];
                        ?>

                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $userId?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $first_name?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo $last_name?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $userName?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="<?php echo $role?>">
                                    <?php
                                    if($role==1)
                                    {
                                        echo '<option value="1" selected>Admin</option>';
                                        echo '<option value="0">Moderator</option>';
                                    }
                                    else {
                                        echo '<option value="1">Admin</option>';
                                        echo '<option value="0" selected>Moderator</option>';
                                    }



                                    ?>


                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required/>
                        </form>

                        <?php
                    }
                }




                ?>


                <!-- /Form -->


            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
