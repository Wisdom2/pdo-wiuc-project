
 <?php 
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    include("includes/security.php");
    include("includes/header.php");
    include("includes/aside.php");
    include("includes/navbar.php");
    include("includes/DatabaseConnect.php");
    include("model/RegisterUser.php");

      $db = new DatabaseConnect();
      $registerUser = new RegisterUser($db->connect());
    ?>

     <!-- Begin Page Content -->
     <div class="container-fluid">

    <?php 
    
     if(isset($_SESSION['success']) && $_SESSION['success'] !='') {
        echo '<h2 class="bg-info text-white">' . $_SESSION['success'] . '</h2>';
        unset($_SESSION['success']);
     }

      if(isset($_SESSION['status']) && $_SESSION['status'] !='') {
         echo '<h2 class="bg-info text-white">' . $_SESSION['status'] . '</h2>';
         unset($_SESSION['status']);
      }

      if(isset($_SESSION['error_msg']) && $_SESSION['error_msg'] !='') {
         echo '<h2 class="bg-danger  text-white">' . $_SESSION['error_msg'] . '</h2>';
         unset($_SESSION['error_msg']);
      }
    ?>

     <div class="row">
     <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                <p class="d-flex justify-content-right">
                  <span class="mr-2">Admin Profile </span><button data-toggle="modal" data-target="#registerModal" class="btn btn-sm btn-primary">Add Admin Profile</button>
                </p>
                <div class="table-responsive">

                <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col" class="text-center">Username</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Password</th>
                                <th scope="col" class="text-center">User Type</th>
                                <th scope="col" class="text-center">Edit</th>
                                <th scope="col" class="text-center">Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                             <?php foreach($registerUser->getRegisters() as $row){ ?>
                             
                                              <tr class="text-center">
                                                  <td><?php echo $row['id']; ?></td>
                                                  <td><?php echo $row['username']; ?></td>
                                                  <td><?php echo $row['email']; ?></td>
                                                  <td><?php echo $row['password']; ?></td>
                                                  <td><?php echo $row['usertype']; ?></td>
                                                  <td class="d-flex justify-content-end">
                                                    <form action="register_edit.php" method="POST">
                                                      <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
                                                      <button type="submit" name="editbtn" class="btn btn-sm btn-success" name=edit_btn">Edit</button> &nbsp;
                                                    </form>
                                              </td>
                                              <td>
                                              <form action="components/deleteUser.php" method="POST">
                                                      <input type="hidden" name="delete_id" name="user_id" value="<?php echo $row['id'];?>">
                                                      <button type="submit" name="deletebtn" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                              </td>
                                              </tr>
                                  <?php }?>
                              </tr>
                            </tbody>
                      </table>
                </div>
                </div>
            </div>
        </div>

     </div>
       <!--./register-->
      <div class="modal fade" id="registerModal"  data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="components/registerUser.php" method="post">
                <div class="form-group">
                  <label for="username" class="col-form-label">Username:</label>
                  <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                  <label for="email" class="col-form-label">Email:</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                  <label for="password" class="col-form-label">Password:</label>
                  <input type="text" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                  <label for="confirm-password" class="col-form-label">Confirm Password:</label>
                  <input type="text" class="form-control" id="confirm-password" name="confirmpassword">
                </div>
                <div class="form-group">
                  <label for="user-type" class="col-form-label">User Type:</label>
                  <select id="user-type" class="form-control" name="usertype">
                    <option value="admin">Admin</option>
                    <option value="user ">User</option>
                  </select>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div> <!--./end of register-->
</div>

</div>
<!-- /.container-fluid -->

<?php 
    include("includes/footer.php");
    include("includes/script.php");

    ?>
