<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 

if(empty($_GET['id'])) redirect("user.php");
else $user = User::find_by_id($_GET['id']);

// print_r($_FILES['usr_pic']); die();

if(isset($_POST['update'])){

    if($user) {

        $user->usr_username = $_POST['usr_username'];
        $user->usr_firstname = $_POST['usr_firstname'];
        $user->usr_lastname = $_POST['usr_lastname'];
        $user->usr_password = isset($_POST['usr_password']) && $_POST['usr_password'] != "" ? $_POST['usr_password'] : $user->usr_password ;

        if(empty($_FILES['usr_pic'])) {
            
            $user->save();
        } else {

            $user->set_file($_FILES['usr_pic']);
            $user->upload_photo();
            $user->save();
        }

        redirect("edit_user.php?id={$user->usr_id}");
    }


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
                            Photos
                            <small>Subheading</small>
                        </h1>
                        <!-- START MAIN FORM -->

                        <div class="col-md-6">
                          <img class="img-respponsive" src="<?=$user->image_path_placehold()?>" alt="User Image">
                        </div>

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <input type="file" name="usr_pic">
                                </div>
                                
                                <div class="form-group">
                                    <label for="usr_username">Username</label>
                                    <input type="text" name="usr_username" class="form-control" value="<?=$user->usr_username?>">
                                </div>

                                <div class="form-group">
                                    <label for="usr_firstname">First Name</label>
                                    <input type="text" name="usr_firstname" class="form-control" value="<?=$user->usr_firstname?>">
                                </div>
                                <div class="form-group">
                                    <label for="usr_lastname">Last Name</label>
                                    <input type="text" name="usr_lastname" class="form-control" value="<?=$user->usr_lastname?>">
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" name="usr_password" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <a href="delete_user.php?id=<?=$user->usr_id?>" class="btn btn-danger">Delete</a>
                                    <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
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