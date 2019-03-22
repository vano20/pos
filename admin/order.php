<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 


$order = Order::find_all();


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
                            Order
                            
                        </h1>

                        <a href="add_order.php" class="btn btn-primary">Add order</a>
                        
                        <div class="col-md-12">
                        
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Invoice</th>
                                        <th>User</th>
                                        <th>Total</th>
                                        <th>Date Created</th>
                                        <th>Last Update</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($order as $v) : 
                                        $user = User::find_by_id($v->users);
                                        ?>
                                    <tr>
                                        <td><?php echo $v->id; ?></td>
                                        <td><?php echo $v->invoice; ?>
                                            <div class="pic_link">
                                                <?php if($session->usergroup == 2) { ?>
                                                <a href="delete_order.php?id=<?php echo $v->id; ?>">Delete</a>
                                                <?php } ?>
                                                <a href="edit_order.php?id=<?php echo $v->id; ?>">Batalkan</a>
                                            </div>

                                        </td>
                                        <td><?php echo $user->full_name; ?></td>
                                        <td><?php echo $v->total; ?></td>
                                        <td><?php echo $v->created_date; ?></td>
                                        <td><?php echo $v->updated_date; ?></td>
                                        <td><?php echo $v->status == 1 ? "Sukses" : "Batal"; ?></td>
                                        <td><a class="btn btn-primary" href="detail_order.php?id=<?=$v->id?>"><?=$v->count_all()?></a></td>
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