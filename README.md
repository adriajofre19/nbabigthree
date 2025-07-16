<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

# 🛠️ Project Setup

Follow these steps to get the application up and running locally:

---

## 📂 Step 1: Import the Database

Make sure your MySQL or MariaDB server is running. Then, import the following files into your database:

- `users.sql`
- `players.sql`

You can import them using a tool like **phpMyAdmin**, **DBeaver**, or the command line.

---

## 🔐 Step 2: Configure Environment Variables

GOOGLE_OAUTH_ID=your_google_client_id

GOOGLE_OAUTH_KEY=your_google_client_secret

php artisan key:generate

## 🚀 Step 3: Start the Development Server

In your project root directory, run the following commands:

### Install frontend dependencies and start Vite:
```bash
npm install       # Only required the first time
npm run dev       
php artisan serve





