// BUKA FORM PEMINJAMAN
document.getElementById("openPopup").onclick = () => {
    document.getElementById("popup").style.display = "flex";
};

// TUTUP FORM PEMINJAMAN
document.getElementById("closePopup").onclick = () => {
    document.getElementById("popup").style.display = "none";
};

// KLIK DI LUAR POPUP FORM
window.addEventListener("click", function (e) {
    if (e.target === document.getElementById("popup")) {
        document.getElementById("popup").style.display = "none";
    }
});

// QUANTITY
let qty = 1;
document.getElementById("minusBtn").onclick = () => {
    if (qty > 1) qty--;
    document.getElementById("qtyValue").textContent = qty;
};
document.getElementById("plusBtn").onclick = () => {
    qty++;
    document.getElementById("qtyValue").textContent = qty;
};

// ================== REMINDER POPUP ==================

// OPEN REMINDER when Borrow Now pressed
document.getElementById("borrowBtn").onclick = () => {
    document.getElementById("popup").style.display = "none";
    document.getElementById("reminderPopup").style.display = "flex";
};

// CLOSE REMINDER
document.getElementById("closeReminder").onclick = () => {
    document.getElementById("reminderPopup").style.display = "none";
};

// NEXT button closes reminder
document.getElementById("nextReminder").onclick = () => {
    document.getElementById("reminderPopup").style.display = "none";
};