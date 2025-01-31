<?php include 'connect.php';

//update logic 

if(isset($_POST['update_product'])){
    $update_product_id=$_POST['update_product_id'];
    echo $update_product_id;
    $update_product_name=$_POST['update_product_name'];
    echo $update_product_name;
    
    $update_product_price=$_POST['update_product_price'];
    $update_product_image=$_FILES['update_product_image']['name'];
    $update_product_image_tmp_name=$_FILES['update_product_image']['tmp_name'];
    $update_product_image_folder='images/' .$update_product_image;

    //update query

    $update_products=mysqli_query($con,"UPDATE products SET name='$update_product_name', price='$update_product_price',
    image='$update_product_image' where id=$update_product_id");
    if($update_products){
        move_uploaded_file($update_product_image_tmp_name,$update_product_image_folder);
        header('location:view.products.php');
    }else{
        $display_message= "There is some error in update the product";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        .edit_btn {
            background-color: black;
            color: rgb(243, 231, 231);
            width: 200px;
            height: 40px;
            border-radius: 5px;
            font-size: 1.8rem;
            border: none;
        }

    .cancel_btn{

        background-color: red;
        color: rgb(248, 242, 242);
        width: 200px;
        height: 40px;
        border-radius: 5px;
        font-size: 1.8rem;
        border: none;
    }
  
    </style>
     <!-- cs file -->
     <link rel="stylesheet" href="css/style.css">

<!-- font awesome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>


 <?php include("header.php")?>
    <div class="card-container">

    <!-- message display -->
 
    <?php
        if(isset($display_message)){
            echo
            "<div class='display_message'>
               <span>$display_message</span>
                 <i class='fas fa-times' onclick='this.parentElement.style.display=`none`'></i>
            </div>";
        }
    ?>
        <section class="card">

        <?php 
          if(isset($_GET['edit'])){
            $edit_id=$_GET['edit'];
            $edit_query=mysqli_query($con, "Select * from products where id=$edit_id");
            if(mysqli_num_rows($edit_query) > 0){

                $fetch_data=mysqli_fetch_assoc($edit_query);
                // $row=$fetch_data['price'];
                // $row=$fetch_data['id'];
                // $row=$fetch_data['name'];
                // echo $row;
               
                ?>
                
            <form action="" method="post" enctype="multipart/form-data" class="update_product product_container_box">
                
                <img src="images/<?php echo isset($fetch_data['image']) ? $fetch_data['image'] : 'default.jpg'; ?>" alt="" style="width: 200px; height: auto;">

                <input type="hidden" value="<?php echo $fetch_data['id']?>" name="update_product_id">
                <input type="text"  class="input_fields fields" required 
                         value="<?php echo $fetch_data['name']?>" name="update_product_name">
                <input type="number"  class="input_fields fields" required 
                         value="<?php echo $fetch_data['price']?>" name="update_product_price">
                <input type="file" class="input_fields fields" name="update_product_image" required accept="image/jpg, image/png ,image/jpeg">

                <div class="btns">
                <input type="submit"  class="edit_btn" value="Update Product" name="update_product">
                <input type="reset"  id="close-edit" value="Cancel" class="cancel_btn">
                </div>
            </form>

                <?php
            }
            
          }

        ?>
           
        </section>
    </div>
</body>
</html>