<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>
<?php if($session->usergroup != 2) redirect("index.php"); ?>

<?php 

if(empty($_GET['id'])) redirect("user.php");
else $user = User::find_by_id($_GET['id']);

// print_r($_FILES['usr_pic']); die();

if(isset($_POST['update'])){

    if($user) {

        $user->username     = $_POST['username'];
        $user->full_name    = $_POST['full_name'];
        $user->usergroup    = $_POST['usergroup'];
        $user->password     = isset($_POST['password']) && $_POST['password'] != "" ? $_POST['password'] : $user->password ;

        $user->save();

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
                            Edit User
                            <small>Subheading</small>
                        </h1>
                        <!-- START MAIN FORM -->

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?=$user->username?>">
                                </div>

                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" value="<?=$user->full_name?>">
                                </div>
                                <div class="form-group">
                                    <label for="usergroup">Usergroup</label>
                                    <select name="usergroup" class="form-control">
                                        <option value=""></option>
                                        <?php
                                        $usergroup = Usergroup::find_all();
                                        foreach($usergroup as $v) : ?>
                                            <option <?=$v->id == $user->usergroup ? "selected" : ""?> value="<?=$v->id?>"><?=$v->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" name="password" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <a href="delete_user.php?id=<?=$user->id?>" class="btn btn-danger">Delete</a>
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