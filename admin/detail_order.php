<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 


$detail = Order_detail::find_sukses();


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
                            Order detail
                            
                        </h1>
                        
                        <div class="col-md-12">
                        
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Orders</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>@</th>
                                        <th>Last Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($detail as $v) : 
                                        $product = Product::find_by_id($v->product);
                                        $order = Order::find_by_id($v->orders);
                                        ?>
                                    <tr>
                                        <td><?php echo $v->id; ?></td>
                                        <td><?php echo $order->invoice; ?>
                                            <div class="pic_link">
                                                <a href="delete_order.php?id=<?php echo $v->id; ?>">Delete</a>
                                                <a href="edit_order.php?id=<?php echo $v->id; ?>">Edit</a>
                                            </div>

                                        </td>
                                        <td><?php echo $product->name; ?></td>
                                        <td><?php echo $v->qty; ?></td>
                                        <td><?php echo $v->price; ?></td>
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