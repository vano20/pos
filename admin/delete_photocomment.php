<?php include("includes/init.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 

if(empty($_GET['id'])) redirect("photos.php");

$comment = Comment::find_by_id($_GET['id']);

if($comment) {
    
    $comment->delete();
    redirect("comment_photo.php?id={$comment->cmt_photo}");
} else 
    redirect("photos.php");


?>