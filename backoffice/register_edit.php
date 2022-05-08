
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
     <div class="col-xl-12 col-lg-8">
            <div class="card shadow mb-4">

           <?php  
           foreach($registerUser->getRegister($_POST['edit_id']) as $data) {?>

           
                <!-- Card Body -->
                <div class="card-body">
                <form action="components/updateRegister.php" method="post">
                <div class="form-group">
                  <label for="username" class="col-form-label">Username:</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?php echo $data['username'] ?? ''; ?>">
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['id'] ?? ''; ?>">
                </div>
                <div class="form-group">
                  <label for="email" class="col-form-label">Email:</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email'] ?? '';?>">
                </div>
                <div class="form-group">
                  <label for="password" class="col-form-label">Password:</label>
                  <input type="text" class="form-control" id="password" name="password" value="<?php echo $data['password'] ?? ''; ?>">
                </div>
                <div class="form-group">
                  <label for="user-type" class="col-form-label">User Type:</label>
                  <select id="user-type" class="form-control" name="usertype">
                    <?php  if($data['usertype'] == 'admin') {?>
                      <option value="<?php echo $data['usertype']; ?>" selected>Admin</option>
                      <option value="user">User</option>
                      <?php } else if($data['usertype'] == 'user') {?>
                        
                            <option value="<?php echo $data['usertype'];?>" selected>User</option>
                            <option value="admin">Admin</option>
                        
                        <?php }?>
                  </option>
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
                </div>
                <?php }?>
            </div>
        </div>

     </div>
     
</div>

</div>
<!-- /.container-fluid -->

<?php 
    include("includes/footer.php");
    include("includes/script.php");

    ?>
