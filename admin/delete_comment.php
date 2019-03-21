<?php include("includes/init.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 

if(empty($_GET['id'])) redirect('comments.php');

$comment = Comment::find_by_id($_GET['id']);

if($comment) {
    
    $comment->delete();
    redirect('comments.php');
} else 
    redirect('comments.php');


?>
