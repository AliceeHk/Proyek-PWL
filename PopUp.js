// BUKA POPUP
document.getElementById("openPopup").onclick = function () {
    document.getElementById("popup").style.display = "flex";
};

// TUTUP POPUP
document.getElementById("closePopup").onclick = function () {
    document.getElementById("popup").style.display = "none";
};

// KLIK DI LUAR POPUP UNTUK CLOSE
window.onclick = function (event) {
    let popup = document.getElementById("popup");
    if (event.target === popup) {
        popup.style.display = "none";
    }
};

// QUANTITY BUTTON
let qty = 1;

document.getElementById("minusBtn").onclick = () => {
    if (qty > 1) qty--;
    document.getElementById("qtyValue").textContent = qty;
};

document.getElementById("plusBtn").onclick = () => {
    qty++;
    document.getElementById("qtyValue").textContent = qty;
};