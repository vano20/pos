<?php include("includes/header.php"); ?>

<?php if(!$session->is_login()) redirect("login.php"); ?>

<?php 


$comment = Comment::find_all();


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
                            Comments
                            
                        </h1>
                        
                        <div class="col-md-12">
                        
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Content</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($comment as $v) :
                                        $user = User::find_by_id($v->cmt_user); ?>
                                    <tr>
                                        <td><?php echo $v->cmt_id; ?></td>
                                        <td><?php echo $user->usr_username; ?>
                                            <div class="pic_link">
                                                <a href="delete_comment.php?id=<?php echo $v->cmt_id; ?>">Delete</a>
                                            </div>

                                        </td>
                                        <td><?php echo $v->cmt_body; ?></td>
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