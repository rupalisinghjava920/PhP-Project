<!-- delete logic -->

<!-- php code -->

<?php

   include  'connect.php';
   if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    $delete_query=mysqli_query($con,"Delete from `products` where id=$delete_id") or
    die("Query failed");
    if($delete_query){
        echo "Product  deleted";
        header('Location:view.products.php');
        exit();
    }else{
        echo "Product not deleted";
        header('Location:view.products.php');
        exit();

    }


   }


?>