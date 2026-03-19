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

function loadCart() {
    fetch("fetch_cart.php")
    .then(res => res.text())
    .then(data => {
        document.querySelector(".cart").innerHTML = "<h3>Cart</h3>" + data;
    });
}

function loadCartCount() {
    fetch("fetch_cart_count.php")
    .then(res => res.text())
    .then(count => {
        document.getElementById("cart-count").innerText = count;
    });
}

document.addEventListener("DOMContentLoaded", function() {
    loadCart();
    loadCartCount();
});

function showToast(message) {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.style.display = "block";

    setTimeout(() => {
        toast.style.display = "none";
    }, 2000);
}

function updateCartUI(id, change) {
    fetch("cart_action.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "action=" + (change > 0 ? "increase" : "decrease") + "&product_id=" + id
    })
    .then(() => {
        // Update UI without reload
        let qtyEl = document.getElementById("qty-" + id);
        let price = parseInt(document.getElementById("price-" + id).innerText);
        let subEl = document.getElementById("sub-" + id);
        let totalEl = document.getElementById("cart-total");

        let qty = parseInt(qtyEl.innerText);
        qty += change;

        if (qty <= 0) {
            document.getElementById("item-" + id).remove();
        } else {
            qtyEl.innerText = qty;
            subEl.innerText = qty * price;
        }

        updateTotal();
        loadCartCount();
    });
}

function removeItemUI(id) {
    fetch("cart_action.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "action=remove&product_id=" + id
    })
    .then(() => {
        document.getElementById("item-" + id).remove();
        updateTotal();
        loadCartCount();
    });
}

function updateTotal() {
    let subs = document.querySelectorAll("[id^='sub-']");
    let total = 0;

    subs.forEach(el => {
        total += parseInt(el.innerText);
    });

    let totalEl = document.getElementById("cart-total");
    if (totalEl) totalEl.innerText = total;
}