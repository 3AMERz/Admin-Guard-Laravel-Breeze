<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Admin Guard Laravel Breeze Project

The Project Has Admin and User Guards with Authentication & Authorization By Laravel Breeze.

# Video

https://github.com/3AMERz/Admin-Guard-Laravel-Breeze/assets/74880250/0f24c3b0-7a09-48c1-8b04-f63940b2a336


## Features

- Two Guards: Admin and User.
- Each of Guardes Has Authentication & Authorization of Their Own.
- Roles and Permissions System for Admins.
- CRUD for Admin, User, Role and Permission Tables.
- Ready Factories & Seeders for Admin and User Tables.

## Installation

First clone this repository, install the dependencies, and setup your .env file.

```
git clone https://github.com/3AMERz/Admin-Guard-Laravel-Breeze.git
composer install
cp .env.example .env
```

Then run the initial migrations and seeders.

```
php artisan migrate --seed
```
