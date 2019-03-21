<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 

$user = new User();

if(isset($_POST['create'])){

    if($user) {

        $user->usr_username = $_POST['usr_username'];
        $user->usr_firstname = $_POST['usr_firstname'];
        $user->usr_lastname = $_POST['usr_lastname'];
        $user->usr_password = $_POST['usr_password'];

        $user->set_file($_FILES['usr_pic']);
        $user->upload_photo();
        $user->save();
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
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="col-md-6 col-md-offset-3">

                                <div class="form-group">
                                    <input type="file" name="usr_pic">
                                </div>
                                
                                <div class="form-group">
                                    <label for="usr_username">Username</label>
                                    <input type="text" name="usr_username" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label for="usr_firstname">First Name</label>
                                    <input type="text" name="usr_firstname" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="usr_lastname">Last Name</label>
                                    <input type="text" name="usr_lastname" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" name="usr_password" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="create" class="btn btn-primary pull-right">
                                </div>
                            </div>
                            <!-- END MAIN FORM -->
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