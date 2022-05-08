<?php $pageTitle = 'About Us';?>
<?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    include("backoffice/includes/DatabaseConnect.php");
    include("backoffice/model/AboutUs.php");

      $db = new DatabaseConnect();
      $aboutUs = new AboutUs($db->connect());

?>
<?php include 'frontoffice/includes/header.php'?>
<?php include 'frontoffice/includes/navbar.php'?>
<div class="container py-5">
    <div class="row">
      <div class="col-md-8 mt-4">
          <div class="card">
            <div class="card-body">
             <img src="frontoffice/images/baptist.jpg" class="w-100" alt="">
          </div>

      </div>
     </div>
       <div class="col-md-4 mt-4">
            <div class="card">
              <div class="card-body">
              <p>Some dummy data</p>
            </div>
        </div>
       </div>
   </div>

     <div class="row mt-3">
       <?php if(empty($aboutUs->getAboutUs())) { ?>
        <div class="col-md-8">
          <div class="card">
            <?php echo "Record not found"?>
          </div>
        </div>
        <?php }  else { ?>
     <?php foreach($aboutUs->getAboutUs() as $row){ ?>

        <div class="col-md-8 mt-3">
          <div class="card">
              <div class="card-header"><?php echo $row['title']; ?></div>
                <div class="card-body">
                <small><?php echo $row['subtitle']; ?></small>
                <p>
                    <?php echo $row['description']; ?>
                </p>
                <p>
                  <a class="btn btn-primary" href="<?php echo $row['link']; ?>" target="_blank"><?php echo $row['link']; ?></a>
                  
                </p>
              </div>

          </div>

      <?php } ?>
        
      <?php }?>
     </div>

  </div>
    
<?php include 'frontoffice/includes/footer.php';?>
 