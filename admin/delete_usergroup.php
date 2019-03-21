<?php include("includes/init.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 

if(empty($_GET['id'])) redirect('usergroup.php');

$usergroup = Usergroup::find_by_id($_GET['id']);

if($usergroup) {
    
    $usergroup->delete();
    redirect('usergroup.php');
}
else 
    redirect('usergroup.php');


?>
