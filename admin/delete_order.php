<?php include("includes/init.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 

if(empty($_GET['id'])) redirect('order.php');

$order = order::find_by_id($_GET['id']);

if($order) {
    
    $order->delete();
    redirect('order.php');
}
else 
    redirect('order.php');


?>
