 
    <!-- header -->
<header class="header">
    <div class="header_body">
        <a href="index.php" class="logo">TechnoBling</a>
        <nav class="navbar">
            <a href="index.php">Add Products</a>
            <a href="view.products.php">View Products</a>
            <a href="shop_product.php">Shopit</a>
        </nav>

<!-- select query -->

 <?php
 
 $select_product=mysqli_query($con, "Select * from `cart`") or die('query failed');
$row_count=mysqli_num_rows($select_product);

?> 

<!-- shopping cart icon -->

       <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup> <?php echo $row_count ?></sup></span></a>

       <!-- <div id="meun-btn" class="fas fa-bars"></div><span><sup></sup></span></div> -->

 </header>
 