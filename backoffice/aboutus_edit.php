
 <?php 
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    include("includes/security.php");

    include("includes/header.php");
    include("includes/aside.php");
    include("includes/navbar.php");
    include("includes/DatabaseConnect.php");
    include("model/AboutUs.php");

    $db = new DatabaseConnect();
    $aboutUs = new AboutUs($db->connect());
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
           foreach($aboutUs->getAboutUsDetail($_POST['edit_id']) as $data) {?>

           
                <!-- Card Body -->
                <div class="card-body">
                <form action="components/updateAboutus.php" method="post">
                <div class="form-group">
                  <label for="title" class="col-form-label">Title:</label>
                  <input type="text" class="form-control" id="title" name="title" value="<?php echo $data['title']?>">
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['id']?>">
                </div>
                <div class="form-group">
                  <label for="subtitle" class="col-form-label">Email:</label>
                  <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?php echo $data['subtitle'];?>">
                </div>
                <div class="form-group">
                  <label for="description" class="col-form-label">Description:</label>
                  <input type="text" class="form-control" id="description" name="description" value="<?php echo $data['description']; ?>">
                </div>
                <div class="form-group">
                  <label for="link" class="col-form-label">Links:</label>
                  <input type="text" class="form-control" id="link" name="link" value="<?php echo $data['link']; ?>">
                </div>
                <div class="form-group">
                  <button type="submit" name="updateAboutUsBtn" class="btn btn-primary">Update</button>
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
