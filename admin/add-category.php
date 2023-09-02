<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->

                  <?php
                  if (isset($_POST['save'])) {
                      require "config.php";
                      $catName = mysqli_real_escape_string($con,$_POST['cat']);
                      $query = "SELECT category_name FROM categories WHERE category_name='{$catName}'";
                      $result = mysqli_query($con, $query);
                      $count = mysqli_num_rows($result);
                      if ($count > 0) {
                          echo "category already exists";
                      } else {
                          $query1 = "INSERT INTO categories (category_name)VALUES( '$catName')";
                          $result2 = mysqli_query($con, $query1);
                          if ($result2) {
                              header("location:category.php");
                          } else {
                              echo "not inset";
                          }
                      }

                  }

                  ?>
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
