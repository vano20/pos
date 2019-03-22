<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>
<?php if($session->usergroup != 2) redirect("index.php"); ?>

<?php 

if(empty($_GET['id'])) redirect("category.php");
else $category = Category::find_by_id($_GET['id']);

// print_r($_FILES['usr_pic']); die();

if(isset($_POST['update'])){

    if($category) {

        $category->name        = $_POST['name'];
        $category->description = $_POST['description'];

        $category->save();

        redirect("edit_category.php?id={$category->id}");
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
                            Edit category
                            <small>Subheading</small>
                        </h1>
                        <!-- START MAIN FORM -->

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?=$category->name?>">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" value="" rows=5><?=$category->description?></textarea>
                                </div>
                                <div class="form-group">
                                    <a href="delete_category.php?id=<?=$category->id?>" class="btn btn-danger">Delete</a>
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