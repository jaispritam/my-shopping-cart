<?php
session_start();
include("include/connection.php");
/*
 =========================
   HANDLE ALL ACTIONS FIRST
   ========================= 

// ADD TO CART
if(isset($_POST['add_to_cart'])) {
    $id = (int)$_POST['product_id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}

// INCREASE
if(isset($_POST['increase'])) {
    $id = (int)$_POST['product_id'];
    $_SESSION['cart'][$id]++;
}

// DECREASE
if(isset($_POST['decrease'])) {
    $id = (int)$_POST['product_id'];
    $_SESSION['cart'][$id]--;

    if($_SESSION['cart'][$id] <= 0) {
        unset($_SESSION['cart'][$id]);
    }
}

// REMOVE
if(isset($_POST['remove'])) {
    $id = (int)$_POST['product_id'];
    unset($_SESSION['cart'][$id]);
}
*/
?>

<?php include("include/header.php"); ?>

<div class="container">

    <!-- =========================
         PRODUCTS SECTION
         ========================= -->
    <div class="products">

        <?php
        $sql = "SELECT p.*, pi.image 
                FROM product p
                LEFT JOIN product_to_image pi 
                ON p.id = pi.product_id";

        $res = mysqli_query($con, $sql);

        while($row = mysqli_fetch_assoc($res)) {
        ?>

            <div class="product">
                <img src="uploads/<?php echo $row['image'] ?: 'default.jpg'; ?>" height="150">

                <h3><?php echo $row['product_name']; ?></h3>
                <p>₹<?php echo $row['product_price']; ?></p>

                
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <button onclick="addToCart(<?php echo $row['id']; ?>)">
                        Add to Cart
                    </button>
               
            </div>

        <?php } ?>

    </div>


    <!-- =========================
         CART SECTION
         ========================= -->
    <div class="cart">
        <h3>Cart</h3>
        
    </div>

</div>

<?php include("include/footer.php"); ?>