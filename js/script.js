function addToCart(id) {
    fetch("cart_action.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "action=add&product_id=" + id
    })
    .then(() => {
        loadCart();
        loadCartCount();
        showToast("Added to cart");
    });
}

function updateCart(id, action) {
    fetch("cart_action.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "action=" + action + "&product_id=" + id
    })
    .then(() => {
        loadCart();
        loadCartCount();
    });
}

// 🔥 NEW FUNCTION
function loadCart() {
    fetch("fetch_cart.php")
    .then(res => res.text())
    .then(data => {
        document.querySelector(".cart").innerHTML = "<h3>Cart</h3>" + data;
    });
}

document.addEventListener("DOMContentLoaded", function() {
    loadCart();
});

function loadCartCount() {
    fetch("fetch_cart_count.php")
    .then(res => res.text())
    .then(count => {
        document.getElementById("cart-count").innerText = count;
    });
}

function showToast(message) {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.style.display = "block";

    setTimeout(() => {
        toast.style.display = "none";
    }, 2000);
}

function showToast(message) {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.style.display = "block";

    setTimeout(() => {
        toast.style.display = "none";
    }, 2000);
}