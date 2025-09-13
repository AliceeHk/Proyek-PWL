# Pagepal

**Pagepal** adalah proyek sederhana berbasis **PHP dan MySQL** yang memungkinkan pengguna untuk menelusuri buku, memfilter berdasarkan kategori, serta mengelola akun dengan halaman **sign up** dan **sign in**. Proyek ini menampilkan integrasi antara landing page, sistem **authentication**, dan koneksi database.  

* Landing page dengan hero, search bar, dan kategori buku.  
* **Authentication** dengan sign up dan sign in.  
* Tampilan responsif dan modern dengan custom CSS.  
* Koneksi database menggunakan PHP (MySQLi).  

## Fitur

* **Landing Page**
  * Navigasi dan hero section.  
  * Search dropdown dengan JavaScript.  
  * Daftar buku dan blok kategori (Matematika, Bahasa Inggris, Sains, dll.).  
  * Footer berisi newsletter, download, dan sosial media.  

* **Authentication**
  * Halaman sign in dengan form login dan placeholder social login.  
  * Halaman sign up dengan form registrasi.  
  * Desain konsisten di setiap halaman.  

* **Database**
  * File `koneksi.php` untuk koneksi database.  
  * Data pengguna disimpan untuk authentication.  
  * Skema database dapat diperluas untuk koleksi buku.  

## Struktur Proyek

```
.
├── koneksi.php              # Koneksi database
├── landingpage.php          # Landing page
├── landingpage.css          # Styling landing page
├── landingpage.js           # Logika search dropdown
├── signin.php               # Halaman sign in
├── signInPage.css           # Styling sign in
├── signup.php               # Halaman sign up
├── signUpPage.css           # Styling sign up
└── wallpaper
```

## Instalasi

1. Clone repository:  

   ```sh
   git clone https://github.com/your-username/pagepal.git
   cd pagepal
   ```

2. Buat database dengan nama `library`.  
   Tambahkan tabel untuk **users** dan **books** sesuai kebutuhan.  

3. Atur konfigurasi koneksi database pada file `koneksi.php`:  

   ```php
   $conn = mysqli_connect("localhost", "root", "", "library");
   ```

4. Jalankan di server lokal (XAMPP, WAMP, atau LAMP):  

   ```
   http://localhost/pagepal/landingpage.php
   ```

## Application Flow

1. Pengguna membuka **Landing Page** dan melihat tampilan awal berisi kategori serta daftar buku.  
2. Jika pengguna ingin melakukan aksi untuk **explore** (misalnya melihat deskripsi buku, membuka daftar semua buku, melihat semua kategori, atau membuka kategori tertentu), maka pengguna diarahkan ke halaman **Sign In**.  
3. Jika pengguna sudah memiliki akun, ia dapat login menggunakan email dan password.  
4. Jika pengguna belum memiliki akun, ia harus melakukan **Sign Up** terlebih dahulu untuk registrasi.  
5. Setelah login berhasil, pengguna dapat menjelajahi koleksi buku sesuai aksi yang dipilih pada landing page.  

## Screenshots

<p align="center">
  <img src="./wallpaper/landing-preview.png" alt="Landing Page" width="700">
</p>

<p align="center">
  <img src="./wallpaper/login-preview.png" alt="Login Page" width="350">
  <img src="./wallpaper/signup-preview.png" alt="Sign Up Page" width="350">
</p>

## Future Improvements

* Hash passwords before storing in database.  
* Add backend validation for authentication.  
* Create book detail and search result pages.  
* Admin dashboard for managing books and users.  

## Author
  
- Alice Holly Kristy  

## Contact

- 📧 Email: **alicehkristyy@gmail.com**  
- 🐙 GitHub: [AliceeHK](https://github.com/AliceeHK)  

## Lisensi

Proyek ini dirilis dengan lisensi **MIT License**.  
