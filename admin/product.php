<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 


$product = Product::find_all();


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
                            product
                            
                        </h1>

                        <a href="add_product.php" class="btn btn-primary">Add product</a>
                        
                        <div class="col-md-12">
                        
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Date Created</th>
                                        <th>Last Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($product as $v) : 
                                        $category = Category::find_by_id($v->category);
                                        ?>
                                    <tr>
                                        <td><?php echo $v->id; ?></td>
                                        <td><?php echo $v->name; ?>
                                            <div class="pic_link">
                                                <a href="delete_product.php?id=<?php echo $v->id; ?>">Delete</a>
                                                <a href="edit_product.php?id=<?php echo $v->id; ?>">Edit</a>
                                            </div>

                                        </td>
                                        <td><?php echo $v->description; ?></td>
                                        <td><?php echo $category->name; ?></td>
                                        <td><?php echo $v->price; ?></td>
                                        <td><?php echo $v->stock; ?></td>
                                        <td><?php echo $v->created_date; ?></td>
                                        <td><?php echo $v->updated_date; ?></td>
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