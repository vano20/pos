s<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>
<?php if($session->usergroup != 2) redirect("index.php"); ?>

<?php 

$order = new Order();

if(isset($_POST['create'])){

    if($order) {

        $orderDetail = new Order_detail();

        $product_price = Product::find_by_id($_POST['product']);

        if($_POST['qty'] > $product_price->stock) redirect("add_order.php");

        $order->invoice       = $_POST['invoice'];
        $order->users          = $_POST['user'];
        $order->created_date  = date("Y-m-d H:i:s");
        $order->updated_date  = date("Y-m-d H:i:s");
        $order->status        = 1;

        $order->create();

        $orderDetail->orders        = $order->id;
        $orderDetail->product       = $product_price->id;
        $orderDetail->qty           = $_POST['qty'];
        $orderDetail->price         = $product_price->price;
        $orderDetail->created_date  = date("Y-m-d H:i:s");
        $orderDetail->updated_date  = date("Y-m-d H:i:s");
        $orderDetail->status        = 1;

        $orderDetail->create();

        $order->total = $orderDetail->qty*$orderDetail->price;

        $order->update();

        if($product_price->deduct_qty($product_price->id,$orderDetail->qty)) redirect("order.php");


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
                            Order
                            <small>Subheading</small>
                        </h1>
                        <!-- START MAIN FORM -->
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="col-md-6 col-md-offset-3">

                                <div class="form-group">
                                    <label for="invoice">Invoice Number</label>
                                    <input type="text" readonly name="invoice" class="form-control" value="<?=$order->create_invoice()?>">
                                </div>

                                <div class="form-group">
                                    <label for="user">By</label>
                                    <?php $user = User::find_by_id($session->user_id); ?>
                                    <input type="hidden" name="user" value="<?=$user->id?>"><div class="form-control"><?=$user->full_name?></div>
                                </div>

                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <select id="select_product" name="product" class="form-control">
                                        <option value=""></option>
                                        <?php
                                        $product = Product::find_all();
                                        foreach($product as $v) : ?>
                                            <option data-price="<?=$v->price?>" value="<?=$v->id?>"><?=$v->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="number" name="qty" placeholder="Qty" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input readonly type="number" name="total" class="form-control" value="">
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

<script type="text/javascript">
$(document).ready(function(){

    $('input[name="qty"]').change(function(){
        var price = $('select[name="product"] > option:selected').attr("data-price");
        var total = $('input[name="qty"]').val() * price;

        $('input[name="total"]').val(total);

    });

});
</script>