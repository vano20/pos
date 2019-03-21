<?php include("includes/header.php"); ?>
<?php

require_once("admin/includes/init.php");


if(empty($_GET['id'])) redirect("index.php");

$photo = Photo::find_by_id($_GET['id']);

if(isset($_POST['submit'])) {

    $cmt_user = $_POST['users'];
    $cmt_body = trim($_POST['comments']);

    $new_comment = Comment::create_comment($photo->pht_id,$cmt_user,$cmt_body);

    if($new_comment && $new_comment->save()) 
        redirect("photo.php?id={$photo->pht_id}");
    else
        $message = "There was some on error on the server";

}

$comments = Comment::find_comment($photo->pht_id);

?>
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?=$photo->pht_title?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?=date('F d, \a\t H:i A',strtotime($photo->pht_dateadded))?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?='admin' . DS . $photo->file_path()?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?=$photo->pht_caption?></p>
                <p><?=$photo->pht_description?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <input type="hidden" name="users" value="1">
                        </div>
                        <div class="form-group">
                            <textarea name="comments" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php if($comments) {
                foreach ($comments as $value) : 
                    $user = User::find_by_id($value->cmt_user); ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object user-image" src="<?='admin' . DS . $user->image_path_placehold()?>" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?=$user->usr_username?>
                            <small><?=$value->cmt_dateadded?></small>
                        </h4>
                        <?=$value->cmt_body?>
                    </div>
                </div>
                <?php endforeach;
                } ?>

            </div>
            <!-- <div class="col-md-4">

            
                 <?php //include("includes/sidebar.php"); ?>


            </div> -->


        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>