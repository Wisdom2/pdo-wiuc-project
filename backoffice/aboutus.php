
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
     <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                <p class="d-flex justify-content-right">
                  <span class="mr-2">Add About us </span><button data-toggle="modal" data-target="#aboutUsModal" class="btn btn-sm btn-primary">Add About Us</button>
                </p>
                <div class="table-responsive">

                <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col" class="text-center">Title</th>
                                <th scope="col" class="text-center">SubTitle</th>
                                <th scope="col" class="text-center">Description</th>
                                <th scope="col" class="text-center">Link</th>
                                <th scope="col" class="text-center">Edit</th>
                                <th scope="col" class="text-center">Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach($aboutUs->getAboutUs() as $row){ ?>
                             
                             <tr class="text-center">
                                 <td><?php echo $row['id']; ?></td>
                                 <td><?php echo $row['title']; ?></td>
                                 <td><?php echo $row['subtitle']; ?></td>
                                 <td><?php echo $row['description']; ?></td>
                                 <td><?php echo $row['link']; ?></td>
                                 <td class="d-flex justify-content-end">
                                   <form action="aboutus_edit.php" method="POST">
                                     <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
                                     <button type="submit" name="editbtn" class="btn btn-sm btn-success">Edit</button> &nbsp;
                                   </form>
                             </td>
                             <td>
                             <form action="components/deleteAboutUs.php" method="POST">
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
       <!--./about us-->
      <div class="modal fade" id="aboutUsModal"  data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">About Us - Modal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="components/aboutUs.php" method="post">
                <div class="form-group">
                  <label for="title" class="col-form-label">Title:</label>
                  <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                  <label for="subtitle" class="col-form-label">Subtitle:</label>
                  <input type="text" class="form-control" id="subtitle" name="subtitle">
                </div>
                <div class="form-group">
                  <label for="description" class="col-form-label">Decription:</label>
                  <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="form-group">
                  <label for="link" class="col-form-label">Links:</label>
                  <input type="text" class="form-control" id="link" name="links">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="aboutUsBtn" class="btn btn-primary">Save</button>
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
