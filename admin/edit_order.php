s<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 

if(empty($_GET['id'])) {

    redirect("order.php");

} else {

    $order = Order::find_by_id($_GET['id']);
    $orderDetail = Order_detail::find_by_order($_GET['id']);

}

if(isset($_POST['cancel'])) {

    $order = Order::find_by_id($_GET['id']);
    $order->status = 0;

    $order->update();

    redirect("order.php");
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
                            Cancel Order
                            <small>Subheading</small>
                        </h1>
                        <!-- START MAIN FORM -->
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="col-md-6 col-md-offset-3">

                                <div class="form-group">
                                    <label for="invoice">Invoice Number</label>
                                    <div><?=$order->invoice?></div>
                                </div>

                                <div class="form-group">
                                    <label for="user">Processed By</label>
                                    <?php $user = User::find_by_id($order->users); ?>
                                    <div><?=$user->full_name?></div>
                                </div>

                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <?php $product = Product::find_by_id($orderDetail->product); ?>
                                    <div><?=$product->name?> : <?=number_format($product->price)?> @ <?=$orderDetail->qty?> pcs</div>
                                </div>

                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <div>Rp. <?=number_format($order->total)?></div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="cancel" class="btn btn-danger pull-right" value="Cancel">
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

<script type="text/javascript">
$(document).ready(function(){

    $('input[name="qty"]').change(function(){
        var price = $('select[name="product"] > option:selected').attr("data-price");
        var total = $('input[name="qty"]').val() * price;

        $('input[name="total"]').val(total);

    });

});
</script>