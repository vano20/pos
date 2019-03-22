<?php include("includes/init.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>
<?php if($session->usergroup != 2) redirect("index.php"); ?>

<?php 

if(empty($_GET['id'])) redirect('product.php');

$product = Product::find_by_id($_GET['id']);

if($product) {
    
    $product->delete();
    redirect('product.php');
}
else 
    redirect('product.php');


?>
