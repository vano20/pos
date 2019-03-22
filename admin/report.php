<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>
<?php if($session->usergroup != 2) redirect("index.php"); ?>

<?php 


$order = Order::report_per_tanggal();

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
                        
                        <div class="col-md-12">
                        
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Invoice</th>
                                        <th>Sukses</th>
                                        <th>Batal</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php 

                                    $no = 0;
                                    foreach($order as $v) : 
                                        $jumlah_invoice = Order::cond_count(" WHERE TO_CHAR(created_date :: DATE, 'dd-mm-yyyy') = '" . $v['tanggal'] . "' ");    
                                    ?>
                                    <tr>
                                        <td><?php echo ++$no; ?></td>
                                        <td><?php echo $v['tanggal']; ?></td>
                                        <td><?php echo $jumlah_invoice; ?></td>
                                        <td><?php echo $v['sukses']; ?></td>
                                        <td><?php echo $v['batal']; ?></td>
                                        <td><a class="btn btn-primary" href="detail_report.php?date=<?=$v['tanggal']?>&success=<?=$v['sukses']?>&cancel=<?=$v['batal']?>">Report</a></td>
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