<?php if(!$session->is_login()) redirect("login.php"); ?>

<div class="container-fluid">

    <?php

    // $product = new Product();

    $j = 1;

    for ($i=1; $i <= 5; $i++) { 
        
        for ($a=1; $a <=2 ; $a++) {

            $product = Product::find_by_id($j); 
            
            // $product->name = "Product $a";
            $product->description = "This product $a is updated from category $i";
            // $product->price = 1000;
            // $product->stock = 99;
            // $product->category = $i;

            echo $product->update() ? "update sukses produk $a category $i" : "update Gagal produk $a category $i";
            echo "<br>";
            $j++;
        }
    }

    // echo "<pre>";
    // print_r($user);

     ?>

</div>
<!-- /.container-fluid -->