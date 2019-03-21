<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 


$photo = Photo::find_all();


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
                            Photos
                            <small>Subheading</small>
                        </h1>
                        
                        <div class="col-md-12">
                        
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Id</th>
                                        <th>File name</th>
                                        <th>Title</th>
                                        <th>Size</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($photo as $v) : ?>
                                    <tr>
                                        <td><img class="admin-photo-thumbnail" src="<?php echo $v->file_path(); ?>" alt="">
                                            <div class="action_link">
                                                <a href="delete_photo.php?id=<?php echo $v->pht_id; ?>">Delete</a>
                                                <a href="edit_photo.php?id=<?php echo $v->pht_id; ?>">Edit</a>
                                                <a href="../photo.php?id=<?=$v->pht_id?>">View</a>
                                            </div>
                                        </td>
                                        <td><?php echo $v->pht_id; ?></td>
                                        <td><?php echo $v->pht_filename; ?></td>
                                        <td><?php echo $v->pht_title; ?></td>
                                        <td><?php echo $v->pht_size; ?></td>
                                        <td><?php $theComment = Comment::find_comment($v->pht_id); ?>
                                            <a href="comment_photo.php?id=<?php echo $v->pht_id; ?>"><?=count($theComment)?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>    
                        
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>