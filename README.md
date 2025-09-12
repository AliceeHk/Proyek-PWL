# Online Library Platform

An online library platform with a landing page, sign-in, and sign-up system built using **PHP, JavaScript, HTML, and CSS**.  
This project also integrates **Size Limit** to ensure optimized JavaScript performance by monitoring bundle sizes and execution time.

---

## Features

- **Landing Page**  
  - Navigation bar with logo and links  
  - Hero section with search functionality  
  - Dynamic dropdown filter for books (`landingpage.js`)  
  - Book showcase and category sections  
  - Footer with app download and social links  

- **Authentication**  
  - **Sign In** (`signin.php` + `signInPage.css`)  
    - Styled login form with Google/social login buttons  
  - **Sign Up** (`signup.php` + `signUpPage.css`)  
    - User registration form with clean UI  

- **Styling**  
  - Custom CSS for landing page, login, and signup pages  
  - Responsive layout with `Platypi` font  
  - Hover effects, background images, and smooth transitions  

- **Performance Monitoring with Size Limit**  
  - Prevents huge dependencies in pull requests  
  - Reports JavaScript bundle size and execution time  
  - GitHub Action integration to reject PRs exceeding limits  

---

## Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript  
- **Backend:** PHP  
- **Styling:** Custom CSS (`landingpage.css`, `signInPage.css`, `signUpPage.css`)  
- **Performance Tooling:**

---

## Project Structure

```
/project-root
│── landingpage.php       # Landing page
│── landingpage.css       # Landing page styling
│── landingpage.js        # Dropdown & search functionality
│── signin.php            # Login page
│── signInPage.css        # Login page styling
│── signup.php            # Registration page
│── signUpPage.css        # Registration page styling
│── koneksi.php           # Database connection
│── /wallpaper            # Background and category images
│── /icon                 # UI icons
```

---

## Usage

1. Clone the repository  
   ```bash
   git clone https://github.com/yourusername/online-library.git
   cd online-library
   ```

2. Set up a local PHP environment (XAMPP, Laragon, or PHP built-in server).  

3. Import your database and configure `koneksi.php` with your DB credentials.  

4. Start the server:  
   ```bash
   php -S localhost:8000
   ```

5. Open [http://localhost:8000/landingpage.php](http://localhost:8000/landingpage.php) in your browser.  

---

## Performance Monitoring with Size Limit

Add **Size Limit** to your project to prevent performance regressions.

### Install  
```bash
npm install --save-dev size-limit @size-limit/preset-app
```

### Add Script in `package.json`
```json
"scripts": {
  "size": "size-limit"
},
"size-limit": [
  {
    "path": "landingpage.js",
    "limit": "10 kB"
  }
]
```

### Run Check
```bash
npx size-limit
```

### GitHub Action Example
```yaml
name: "size"
on:
  pull_request:
    branches: [master]
jobs:
  size:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v1
      - uses: andresz1/size-limit-action@v1
        with:
          github_token: ${{ secrets.GITHUB_TOKEN }}
```

---

## Credits

- **UI & Styling:** Custom CSS (`Platypi` font, hover effects, responsive design)  
- **Performance Tool:** [Size Limit](https://github.com/ai/size-limit) – by [Evil Martians](https://evilmartians.com/)  
- **Logo & Icons:** Custom assets  

---

## Authors

- Alice Holly Kristy  
- Nichole Angelly  
- Alfredy Rudi  
