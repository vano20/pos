<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 


if(empty($_GET['id'])) redirect("../photos.php");
else $photo = Photo::find_by_id($_GET['id']);

if(isset($_POST['update'])){

    if($photo) {

        $photo->pht_title = $_POST['pht_title'];
        $photo->pht_caption = $_POST['pht_caption'];
        $photo->pht_alternatetext = $_POST['pht_alternatetext'];
        $photo->pht_description = $_POST['pht_description'];

        $photo->save();
    }


}

// $photo = Photo::find_all();


?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            


            <?php include("includes/top_nav.php"); ?>




            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            

            <?php include("includes/side_nav.php") ?>


            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

             <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Photos
                            <small>Subheading</small>
                        </h1>
                        <!-- START MAIN FORM -->
                        <form action="" method="post">
                            <div class="col-md-8">
                                
                                <div class="form-group">
                                    <input type="text" name="pht_title" class="form-control" value="<?=$photo->pht_title?>">
                                </div>

                                <div class="form-group">
                                    <a class="thumbnail" href="#"><img src="<?=$photo->file_path()?>" alt=""></a>
                                </div>

                                <div class="form-group">
                                    <label for="caption">Caption</label>
                                    <input type="text" name="pht_caption" class="form-control" value="<?=$photo->pht_caption?>">
                                </div>
                                <div class="form-group">
                                    <label for="caption">Alternate Text</label>
                                    <input type="text" name="pht_alternatetext" class="form-control" value="<?=$photo->pht_alternatetext?>">
                                </div>
                                <div class="form-group">
                                    <label for="caption">Description</label>
                                    <textarea name="pht_description" id="" cols="30" rows="10" class="form-control"><?=$photo->pht_description?></textarea>
                                </div>
                            
                            </div>
                            <!-- END MAIN FORM -->
                            <!-- START SIDE BAR SNIPPET -->
                            <div class="col-md-4" >
                                <div  class="photo-info-box">
                                    <div class="info-box-header">
                                       <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                    </div>
                                <div class="inside">
                                  <div class="box-inner">
                                     <p class="text">
                                       <span class="glyphicon glyphicon-calendar"></span> Uploaded on: <?php //$photo->pht_dateadded; ?>
                                      </p>
                                      <p class="text ">
                                        Photo Id: <span class="data photo_id_box"><?=$photo->pht_id?></span>
                                      </p>
                                      <p class="text">
                                        Filename: <span class="data"><?=$photo->pht_filename?></span>
                                      </p>
                                     <p class="text">
                                      File Type: <span class="data"><?=$photo->pht_type?></span>
                                     </p>
                                     <p class="text">
                                       File Size: <span class="data"><?=$photo->pht_size?></span>
                                     </p>
                                  </div>
                                  <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                    </div>   
                                  </div>
                                </div>          
                            </div>
                        </div>
                    <!-- END SIDE BAR SNIPPET -->
                    </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>