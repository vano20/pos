<?php include("includes/init.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 

if(empty($_GET['id'])) redirect('category.php');

$category = Category::find_by_id($_GET['id']);

if($category) {
    
    $category->delete();
    redirect('category.php');
}
else 
    redirect('category.php');


?>
