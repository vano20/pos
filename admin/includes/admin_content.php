<?php if(!$session->is_login()) redirect("login.php"); ?>

<div class="container-fluid">

    <?php

    $user = User::find_by_id(7);

    // $user = new User();

    // $user->username = "test";
    // $user->password = "testDelete";
    // $user->full_name = "Account Dummy";
    // $user->usergroup = ADMIN;

    // echo $user->delete() ? "Delete sukses" : "Delete Gagal";

    echo "<pre>";
    print_r($user);

     ?>

</div>
<!-- /.container-fluid -->