<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>
<?php if($session->usergroup != 2) redirect("index.php"); ?>

<?php 

if(empty($_GET['date'])) redirect("report.php");
else $order = Order::report_tanggal($_GET['date']);

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
                            Report by date
                            
                        </h1>

                        <div class="row">
                
                            <div id="piechart" style="width: 900px; height: 500px;"></div>

                        </div>
                        
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
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php foreach($order as $v) : 
                                        $user = User::find_by_id($v->users);
                                        ?>
                                    <tr>
                                        <td><?php echo $v->id; ?></td>
                                        <td><?php echo $v->invoice; ?></td>
                                        <td><?php echo $user->full_name; ?></td>
                                        <td><?php echo $v->total; ?></td>
                                        <td><?php echo $v->created_date; ?></td>
                                        <td><?php echo $v->updated_date; ?></td>
                                        <td><?php echo $v->status == 1 ? "Sukses" : "Batal"; ?></td>
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