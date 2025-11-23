// Navigation between profile sections
document.addEventListener('DOMContentLoaded', function() {
    // Navigation functionality
    const navItems = document.querySelectorAll('.nav-item');
    const contentSections = document.querySelectorAll('.content-section');
    
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            if (this.classList.contains('logout')) return;
            
            e.preventDefault();
            
            // Remove active class from all nav items and sections
            navItems.forEach(nav => nav.classList.remove('active'));
            contentSections.forEach(section => section.classList.remove('active'));
            
            // Add active class to clicked nav item
            this.classList.add('active');
            
            // Show corresponding section
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.classList.add('active');
            }
        });
    });
    
    // Password confirmation validation
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const form = document.querySelector('.settings-form form');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            if (password.value !== '' && password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Password dan Konfirmasi Password tidak cocok!');
                confirmPassword.focus();
                return false;
            }
        });
    }
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    });
    
    // Avatar upload functionality - SIMPLIFIED VERSION
    const avatarContainer = document.getElementById('avatarContainer');
    const avatarInput = document.getElementById('avatarInput');
    const fileInput = document.getElementById('foto_profil');

    if (avatarContainer && avatarInput) {
        avatarContainer.addEventListener('click', function() {
            // Trigger both file inputs to be safe
            avatarInput.click();
            if (fileInput) fileInput.click();
        });
    }

    // Handle file selection and auto-submit
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Simple validation
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                const maxSize = 2 * 1024 * 1024; // 2MB
                
                if (!allowedTypes.includes(file.type)) {
                    alert('File harus berupa gambar (JPG, PNG, GIF)');
                    return;
                }
                
                if (file.size > maxSize) {
                    alert('Ukuran file maksimal 2MB');
                    return;
                }
                
                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatarImage = document.getElementById('avatarImage');
                    if (avatarImage) {
                        avatarImage.src = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
                
                // Auto-submit form after a short delay to show preview
                setTimeout(() => {
                    const form = document.querySelector('.settings-form form');
                    if (form) {
                        form.submit();
                    }
                }, 500);
            }
        });
    }
});