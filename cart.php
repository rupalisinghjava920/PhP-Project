<?php include 'connect.php'; 

//update query
if(isset($_POST['update_product_quantity'])){
  $update_value=$_POST['update_quantity'];
  $update_id=$_POST['update_quantity_id'];
  $update_quantity_query=mysqli_query($con, "update `cart` set quantity=$update_value where id=$update_id");
  if($update_quantity_query){
    header('location:cart.php');
  }
}

if(isset($_GET['remove'])){
  $remove_id = $_GET['remove']; 
 mysqli_query($con, "DELETE FROM `cart` WHERE id = '$remove_id'");
  header('location:cart.php');
  
}

if(isset($_GET['delete_all'])){ 
 mysqli_query($con, "DELETE FROM `cart`");
  //header('location:cart.php');
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
  <style>

    .shopping_cart {
    width: 90%; 
    margin: 20px auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.shopping_cart h1 {
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

thead {
    background:  #1f655e !important;
    color: white !important;
}

th, td {
    padding: 12px;
    border: 2px solid #ddd;
    text-align: center;
    font-size: 16px;
}

th {
    font-weight: bold;
}


/* Action Buttons */
.action-btn {
    background: red;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

td img {
    width: 60px;
    height: 60px;
    border-radius: 5px;
    object-fit: cover;
    border: 1px solid #ddd;
}

.quantity_box {
    display: flex;
    justify-content: center;
    align-items: center;
}

.quantity_box input[type="number"] {
    width: 50px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
    
}

.update_quantity {
    background: black !important;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    margin-left: 5px;
    border-radius: 5px;
    font-size: 14px;
}
.update_quantity:hover {
    background: #218838;
}

td:last-child {
    color: blue;
    cursor: pointer;
    font-weight: bold;
}

.table_bottom{
  display: flex;
  justify-content: space-between;
  align-items: center;
  text-align: center; 
  width: 950px;
  height: 60px;
  padding-left:5px;
  background:black !important;
  padding-right:5px ;
  margin-top: 5px ;
}

.bottom_btn {
    display: inline-block;
    padding: 10px 20px;
    background: #1f655e; 
    color: white;  
    text-decoration: none;
    border-radius: 5px;
    font-size: 18px;
 
}

.bottom_btn h3 {
    font-size: 22px;
    font-weight: bold;
    color: #1f655e;
}

.delete_all_btn {
    margin-top:5px;
    display: inline-flex; 
    padding: 10px 15px;
    background: black; 
    color: red; 
    text-decoration: none;
    border-radius: 5px;
    font-size: 15px;
    justify-content:start;
    border: none;
    cursor: pointer;
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
      
      <?php include 'header.php'; ?>

      <div class="card-container">
        <section class="shopping_cart">
          <h1>My Cart</h1>
          <table>

          <?php

          $select_cart_products=mysqli_query($con, "Select * from `cart`");
          $num=1;
          $grand_total=0;
          if(mysqli_num_rows($select_cart_products) >0){
              echo "<thead>
                    <th>S1 No</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                  </thead>
                  <tbody>";
                  while($fetch_cart_products=mysqli_fetch_assoc($select_cart_products)){

                    ?>

                <tr>
                    <td><?php echo $num ?></td>
                    <td><?php echo $fetch_cart_products['name'] ?></td>

                    <td>
                      <img src="images/<?php echo  $fetch_cart_products['image'] ?>" alt="Headphone">
                    </td>

                    <td>$<?php echo number_format($fetch_cart_products['price'] )?>/-</td>

                    <td>
                      <form action="" method="post">
                        <input type="hidden" value="<?php echo $fetch_cart_products['id'] ?> " name="update_quantity_id">
                      <div class="quantity_box">
                        <input type="number" min="1" value="<?php echo $fetch_cart_products['quantity'] ?>" name="update_quantity">
                        <input type="submit" class="update_quantity" value="update" name="update_product_quantity">
                      </div>
                      </form>
                    </td>

                    <td>$<?php echo $subtotal=number_format($fetch_cart_products['price'] *$fetch_cart_products['quantity'])?>/-</td>

                    <td>
                      <a href="cart.php?remove=<?php echo $fetch_cart_products['id']?>"
                         onclick="return confirm('Are you sure you want to delete this item')" >
                        <i class="fas fa-trash"></i> Remove</a>
                    </td>

                </tr>                  

                    <?php
                         $grand_total+=($fetch_cart_products['price']*$fetch_cart_products['quantity']);

                    $num++;
                  }
          }else{
            echo "<div class='empty_text'>Cart is Empty</div>";
          }
          ?>
            
            </tbody>  
          </table>
		     <!-- bottom area -->
          <?php
           if($grand_total >0){
            echo '<div class="table_bottom">
            <a href="shop_product.php" class="bottom_btn">Coutinue Shopping</a>
            <h3 class="bottom_btn">Grand total: <span>$'.$grand_total.'/-</span></h3>
            
           </div>';
          
          ?>

           <a href="cart.php?delete_all" class="delete_all_btn">
            <i class="fa fa-trash"> Delete All</i>
           </a>

           <?php
              }else{

              }
           ?>
        </section>
      </div>

      <script src="js/script.js"></script>
      <!-- <a href="checkout.php" class="bottom_btn">Proceed to checkout</a>-->
</body>
</html>