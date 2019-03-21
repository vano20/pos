<?php include("includes/init.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 

if(empty($_GET['id'])) redirect('user.php');

$user = User::find_by_id($_GET['id']);

if($user) {
    
    $user->delete();
    redirect('user.php');
}
else 
    redirect('user.php');


?>
