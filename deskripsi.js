    // BUKA POPUP FORM PEMINJAMAN
    document.getElementById("borrowBtn").onclick = function () {
        document.getElementById("popup").style.display = "flex";
    };

    // TUTUP POPUP FORM PEMINJAMAN
    document.getElementById("closePopup").onclick = function () {
        document.getElementById("popup").style.display = "none";
    };

    // KLIK DI LUAR POPUP UNTUK CLOSE
    window.onclick = function (event) {
        let popup = document.getElementById("popup");
        let reminderPopup = document.getElementById("reminderPopup");
        
        if (event.target === popup) {
            popup.style.display = "none";
        }
        if (event.target === reminderPopup) {
            reminderPopup.style.display = "none";
            // Reset ke halaman 1 saat tutup
            document.getElementById("reminderPage1").classList.add("active");
            document.getElementById("reminderPage2").classList.remove("active");
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

    // ================== REMINDER POPUP ==================

    // OPEN REMINDER when Submit Borrow pressed
    document.getElementById("submitBorrow").onclick = () => {
        document.getElementById("popup").style.display = "none";
        document.getElementById("reminderPopup").style.display = "flex";
        // Pastikan halaman 1 yang aktif saat pertama kali dibuka
        document.getElementById("reminderPage1").classList.add("active");
        document.getElementById("reminderPage2").classList.remove("active");
    };

    // CLOSE REMINDER
    document.getElementById("closeReminder").onclick = () => {
        document.getElementById("reminderPopup").style.display = "none";
        // Reset ke halaman 1 saat tutup
        document.getElementById("reminderPage1").classList.add("active");
        document.getElementById("reminderPage2").classList.remove("active");
    };

    // NEXT button untuk pindah ke halaman 2 reminder
    document.getElementById("nextReminder").onclick = () => {
        document.getElementById("reminderPage1").classList.remove("active");
        document.getElementById("reminderPage2").classList.add("active");
    };

    // CONFIRM button untuk menutup reminder
    document.getElementById("confirmReminder").onclick = () => {
        document.getElementById("reminderPopup").style.display = "none";
        // Reset ke halaman 1 saat tutup
        document.getElementById("reminderPage1").classList.add("active");
        document.getElementById("reminderPage2").classList.remove("active");
    };