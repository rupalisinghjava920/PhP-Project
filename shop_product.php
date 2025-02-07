<?php
  include 'connect.php';

  if(isset($_POST['add_to_cart'])){
    $products_name=$_POST['product_name'];
    $products_price=$_POST['product_price'];
    $products_image=$_POST['product_image'];
    $product_quantity=1;


    //select cart data based on condtion

    $select_cart=mysqli_query($con ,"Select * from `cart` where name='$products_name'");
    if(mysqli_num_rows($select_cart) >0){
        $display_message="Product already added to cart";
    }

    else{
         //insert cart data in cart table
    $insert_products=mysqli_query($con, "INSERT INTO `cart` (name,price,image,quantity) VALUES
     ('$products_name','$products_price','$products_image','$product_quantity')");
         $display_message="Product added to cart";
    }
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Product Project</title>

    <!-- css link -->
    <link rel="stylesheet" href="css/style.css">
    
    <style>

        .heading{
        text-align: center;
        font-size: 25px;
        margin: 20px 0;
        color: #333;
        }

        .product_container {
            display: flex;
            flex-wrap: wrap; 
            justify-content: center; 
            gap: 20px; 
            overflow: hidden;
        }

        .edit_form {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 250px; 
            text-align: center;
            
        }

        .edit_form:hover {
            transform: translateY(-5px);
        }
        .edit_form img {
            max-width: 100%;
            max-height: 150px; 
            height: auto;
            object-fit: contain; 
            border-radius: 10px;
            
            
        }
        

        .edit_form h3 {
            font-size: 24px;
            color: #333;
            margin: 15px 0;
        }
        .price {
            font-size: 18px;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .submit_btn {
    background-color: rgb(22, 23, 23); 
    color: #fff; 
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-block;
    width: 100%;
}

.submit_btn:hover {
    background-color: #e74c3c; 
    transform: scale(1.05); 
    box-shadow: 0px 4px 10px rgba(231, 76, 60, 0.5); 
}




    </style>
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    
  <!-- header -->
<?php include 'header.php'?>


<div class="container">

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

     <section class="class product">
        <h1 class="heading">Lets Shop</h1>
        <div class="product_container">

        <?php
           $select_products=mysqli_query($con, "Select * from `products`");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product=mysqli_fetch_assoc($select_products)){
                    ?>
                    
                    <form action=""  method="post" >
                        <div class="edit_form">
                            <img src="images/<?php echo $fetch_product['image'];?>" alt="<?php echo $fetch_product['name']; ?>" >
                            <h3><?php echo $fetch_product['name'];?></h3>
                            <div class="price">Price <?php echo $fetch_product['price'];?> /-</div>
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <input type="submit" class="submit_btn cart_btn" value="Add to Cart" name="add_to_cart">
                        </div>
                    </form>
           
                    <?php
                }

                //echo $fetch_product['name'];
            }else{
                echo "No products";
            }
        ?>
            
        </div>
     </section>


</div>
</body>
</html>