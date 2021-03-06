<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>
<?php if($session->usergroup != 2) redirect("index.php"); ?>

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
                                        <th>Username</th>
                                        <th>Full Name</th>
                                        <th>Usergroup</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($user as $v) : 
                                        $usergroup = Usergroup::find_by_id($v->usergroup);
                                        ?>
                                    <tr>
                                        <td><?php echo $v->id; ?></td>
                                        <td><?php echo $v->username; ?>
                                            <div class="pic_link">
                                                <a href="delete_user.php?id=<?php echo $v->id; ?>">Delete</a>
                                                <a href="edit_user.php?id=<?php echo $v->id; ?>">Edit</a>
                                            </div>

                                        </td>
                                        <td><?php echo $v->full_name; ?></td>
                                        <td><?php echo $usergroup->name; ?></td>
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