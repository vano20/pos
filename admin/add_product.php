s<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>
<?php if($session->usergroup != 2) redirect("index.php"); ?>

<?php 

$product = new product();

if(isset($_POST['create'])){

    if($product) {

        $product->name         = $_POST['name'];
        $product->description  = $_POST['description'];
        $product->category     = $_POST['category'];
        $product->price        = $_POST['price'];
        $product->stock        = $_POST['stock'];
        $product->created_date = date("Y-m-d H:i:s");
        $product->updated_date = date("Y-m-d H:i:s");

        $product->save();
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
                            Product
                            <small>Subheading</small>
                        </h1>
                        <!-- START MAIN FORM -->
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="col-md-6 col-md-offset-3">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" class="form-control">
                                        <option value=""></option>
                                        <?php
                                        $category = Category::find_all();
                                        foreach($category as $v) : ?>
                                            <option value="<?=$v->id?>"><?=$v->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="price">price</label>
                                    <input type="number" name="price" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" class="form-control" value="">
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