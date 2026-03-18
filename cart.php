<?php
if(!empty($_SESSION['cart'])) {

    $total = 0;

    foreach($_SESSION['cart'] as $id => $qty) {

        $q = mysqli_query($con, "SELECT * FROM product WHERE id=$id");
        $p = mysqli_fetch_assoc($q);

        if(!$p) continue;

        $sub = $p['product_price'] * $qty;
        $total += $sub;
?>

<div class="cart-item">
    <b><?php echo $p['product_name']; ?></b><br>
    Qty: <?php echo $qty; ?><br>
    ₹<?php echo $sub; ?>

    <form method="post">
        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
       <button onclick="updateCart(<?php echo $id; ?>, 'increase')">+</button>
       <button onclick="updateCart(<?php echo $id; ?>, 'decrease')">-</button>
       <button onclick="updateCart(<?php echo $id; ?>, 'remove')">Remove</button>
       
    </form>
</div>

<?php
    }

    echo "<h4>Total: ₹$total</h4>";
} else {
    echo "Cart is empty";
}
?>