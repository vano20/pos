<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 


$user = User::find_all();


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
                            Users
                            
                        </h1>

                        <a href="add_user.php" class="btn btn-primary">Add User</a>
                        
                        <div class="col-md-12">
                        
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($user as $v) : ?>
                                    <tr>
                                        <td><?php echo $v->usr_id; ?></td>
                                        <td><img class="admin-photo-thumbnail user-image" src="<?php echo $v->image_path_placehold(); ?>" alt="">
                                        </td>
                                        <td><?php echo $v->usr_username; ?>
                                            <div class="pic_link">
                                                <a href="delete_user.php?id=<?php echo $v->usr_id; ?>">Delete</a>
                                                <a href="edit_user.php?id=<?php echo $v->usr_id; ?>">Edit</a>
                                            </div>

                                        </td>
                                        <td><?php echo $v->usr_firstname; ?></td>
                                        <td><?php echo $v->usr_lastname; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>    
                        
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>