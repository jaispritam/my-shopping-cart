<?php
include("../include/connection.php");

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];

    mysqli_query($con, "INSERT INTO product(product_name, product_price) VALUES('$name','$price')");
}
?>

<form method="post">
    <input type="text" name="name" placeholder="Product Name">
    <input type="text" name="price" placeholder="Price">
    <button name="submit">Add Product</button>
</form>