# Library Web App

Library Web App is a simple PHP and MySQL based project that allows users to
browse books, filter by categories, and manage accounts with sign up and sign in
pages. It demonstrates integration of a landing page, authentication system, and
database connectivity.

* Landing page with hero, search bar, and category browsing.
* User authentication with sign up and sign in.
* Styled with custom CSS for responsive, modern UI.
* Database connection handled via PHP and MySQLi.

## Features

* **Landing Page**
  * Navigation bar and hero section.
  * Search dropdown powered by JavaScript.
  * Book listings and category blocks (Math, English, Science, etc.).
  * Footer with newsletter/download and social links.

* **Authentication**
  * Sign in page with styled form and social login placeholders.
  * Sign up page with registration form.
  * Shared design language for consistency.

* **Database**
  * `koneksi.php` for MySQL connection.
  * Users stored in database for authentication.
  * Books can be extended in the schema.

## Project Structure

```
.
├── koneksi.php              # Database connection
├── landingpage.php          # Landing page
├── landingpage.css          # Landing page styling
├── landingpage.js           # Search dropdown logic
├── signin.php               # Sign in page
├── signInPage.css           # Sign in styling
├── signup.php               # Sign up page
├── signUpPage.css           # Sign up styling
└── Proyek PWL/
    └── wallpaper/           # Backgrounds and screenshots
```

## Installation

1. Clone the repository:

   ```sh
   git clone https://github.com/your-username/library-webapp.git
   cd library-webapp
   ```

2. Set up the database:

   ```sql
   CREATE DATABASE library;
   USE library;

   CREATE TABLE users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(50) NOT NULL UNIQUE,
     email VARCHAR(100) NOT NULL UNIQUE,
     password VARCHAR(255) NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE books (
     id INT AUTO_INCREMENT PRIMARY KEY,
     title VARCHAR(255) NOT NULL,
     author VARCHAR(100),
     category VARCHAR(50),
     cover_image VARCHAR(255),
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

3. Configure database credentials in `koneksi.php`:

   ```php
   $conn = mysqli_connect("localhost", "root", "", "library");
   ```

4. Run with a local server (XAMPP, WAMP, or LAMP):

   ```
   http://localhost/library-webapp/landingpage.php
   ```

## Screenshots

<p align="center">
  <img src="./Proyek%20PWL/wallpaper/landing-preview.png" alt="Landing Page" width="700">
</p>

<p align="center">
  <img src="./Proyek%20PWL/wallpaper/login-preview.png" alt="Login Page" width="350">
  <img src="./Proyek%20PWL/wallpaper/signup-preview.png" alt="Sign Up Page" width="350">
</p>

## Future Improvements

* Hash passwords before storing in database.
* Add backend validation for authentication.
* Create book detail and search result pages.
* Admin dashboard for managing books and users.

## License

This project is released under the MIT License.
