<?php
session_start();
include("include/connection.php");

if(!empty($_SESSION['cart'])) {

    $total = 0;

    foreach($_SESSION['cart'] as $id => $qty) {

        $id = (int)$id;

        $q = mysqli_query($con, "SELECT * FROM product WHERE id=$id");
        $p = mysqli_fetch_assoc($q);

        if(!$p) continue;

        $sub = $p['product_price'] * $qty;
        $total += $sub;
?>

<div class="cart-item" id="item-<?php echo $id; ?>">

    <b><?php echo $p['product_name']; ?></b><br>

    Price: ₹<span id="price-<?php echo $id; ?>">
        <?php echo $p['product_price']; ?>
    </span><br>

    Qty:
    <button onclick="updateCartUI(<?php echo $id; ?>, -1)">-</button>
    <span id="qty-<?php echo $id; ?>"><?php echo $qty; ?></span>
    <button onclick="updateCartUI(<?php echo $id; ?>, 1)">+</button>

    <br>

    Subtotal: ₹
    <span id="sub-<?php echo $id; ?>">
        <?php echo $sub; ?>
    </span>

    <br>

    <button onclick="removeItemUI(<?php echo $id; ?>)">Remove</button>

</div>

<?php
    }

    echo "<h3>Total: ₹<span id='cart-total'>$total</span></h3>";

} else {
    echo "<h3>Cart is empty</h3>";
}
?>