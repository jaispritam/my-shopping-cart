<?php
session_start();

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if(isset($_POST['action'])) {

    $id = (int)$_POST['product_id'];

    if($_POST['action'] == 'add') {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }

    if($_POST['action'] == 'increase') {
        $_SESSION['cart'][$id]++;
    }

    if($_POST['action'] == 'decrease') {
        $_SESSION['cart'][$id]--;

        if($_SESSION['cart'][$id] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }

    if($_POST['action'] == 'remove') {
        unset($_SESSION['cart'][$id]);
    }

    echo "success";
}
?>