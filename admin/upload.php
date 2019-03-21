<?php include("includes/header.php"); ?>
<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 

$message = "";

if(isset($_POST['submit'])) {

    $photo = new Photo();
    $photo->pht_title = $_POST['pht_title'];
    $photo->set_file($_FILES['file_upload']);

    if($photo->save()) $message = "Photo uploaded successfully";
    else $message = join("<br>", $photo->errors);

}

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
                            Uploads
                            <small>Subheading</small>
                        </h1>

                        <div class="col-md-6">
                            <?php echo $message; ?>
                            <form action="" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    
                                    <input type="text" name="pht_title" class="form-control" placeholder="Title">

                                </div>
                                <div class="form-group">
                                    
                                    <input type="file" name="file_upload">

                                </div>
                                <input type="submit" name="submit">

                            </form>
                        </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>