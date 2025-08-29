# Social Media App

A simple PHP + MySQL + Bootstrap web application that allows users to register, log in, edit their profile, and create posts.

## Features
- User registration and login (session-based authentication)
- Profile management (picture, bio, gender, birthday, email)
- Bio truncation with “See more” toggle
- Posts displayed in a central feed
- Bootstrap-styled UI with responsive layout
- Secure password hashing and CSRF protection

## Tech Stack
- **Backend:** PHP 8+
- **Frontend:** Bootstrap 5, custom CSS
- **Database:** MySQL
- **Server:** Apache (XAMPP recommended)

## Installation
1. Clone or extract the project into your web server root (e.g. `htdocs` for XAMPP).

2. Import the database schema:

   ```sql
   CREATE DATABASE social_media_app;
   USE social_media_app;
   SOURCE database/schema.sql;

3. Update database credentials in config/config.php:

	```$host = "localhost";
	$dbname = "social_media_app";
	$user = "root";
	$password = "";

4. Start Apache and MySQL, then open in your browser:

	http://localhost/SocialMediaApp/public

## Project Structure

config/        # Database configuration  
database/      # schema.sql for setup  
includes/      # header, footer, csrf helpers  
public/        # main pages (index, login, register, profile, logout)  
assets/        # css, js, images  

## Future Improvements

Likes & comments on posts

Image uploads in posts

Friend/follow system

REST API for integration

## Test Accounts
#### Account 1: 
email: harry@gmail.com,
password: 123456

#### Account 2:
email: anna@gmail.com,
password: password

### Made by Murugupillai, Kirththiga & Echavarria-Mercier, Aleksandro
