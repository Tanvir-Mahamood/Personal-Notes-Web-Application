# Personal Notes Web Application

## Overview
This project is a web-based application that allows multiple users to sign up, log in, and securely manage their personal notes. 
Each user has the ability to create, read, update, and delete their notes. The application is built with security in mind, ensuring that each user's data is protected.

## Prerequisites:
1. XAMPP Installed: Ensure XAMPP is installed and running on your local machine. This package includes Apache web server, MySQL database, and PHP.
2. Code Editor or IDE: Choose a suitable code editor or integrated development environment (IDE) to work with PHP code. Popular options include Visual Studio Code, Sublime Text, PhpStorm, and NetBeans.

## Features
It’s a CRUD Application. CRUD is a specific type of application that supports the four basic operations: Create, read, update, and delete.<br>

### User Authentication:
- Users can sign up for a new account.
- During the signup process, duplication of email and username is restricted.
- Users can log in using their credentials.
- Sessions are managed securely to protect user data.

### Personal Notes Management:
- Users can create new personal notes.
- Users can view their existing notes.
- Users can update and delete their notes as needed.

### Responsive Design:
- The application is responsive and works well on both desktop and mobile devices.


## Technologies Used
- Front-End:
  - HTML & Bootstrap: Used for designing the user interface, ensuring it's responsive and user-friendly.
  - JavaScript: Implemented for enhancing responsiveness, interactivity, and managing dynamic content.
  - JTable: Used for displaying notes in a tabular format, providing functionalities such as sorting and searching.
- Back-End:
  - PHP: Server-side scripting language used to handle user authentication, session management, and CRUD operations on notes.
  - MySQL (XAMPP): Used as the database to securely store user information and notes.


## Database Structure
The application uses a MySQL database with the following structure:<br>
1. Users Table:
   - sno (Primary Key and auto-incremented)
   - user_email
   - user_name
   - user_pass (Hashed for security)
   - timestamp (to store operation time)
2. Notes Table:
   - sno (Primary Key)
   - user_sno
   - title
   - description
   - tstamp (to store operation time)

## Security Measures
- Password Hashing: User passwords are hashed before being stored in the database to ensure security.
- Prepared Statements: All database queries are executed using prepared statements to prevent SQL injection attacks.
- Session Management: Sessions are managed securely, ensuring that user data is protected throughout their interaction with the application.
  
## Installation
1. Clone the repository to your local machine.

```
git clone 
```

2. Navigate to the project directory.
cd personal-notes-app
3. Set up your MySQL database using the provided SQL script.
4. Configure your _dbconnect.php file with your database credentials.
5. Start the XAMPP server and navigate to the project in your browser.

## Usage
- Sign up or log in to your account.
- Manage your personal notes with ease through the user-friendly interface.

## Future Enhancements
- Email Verification: Implementing email verification during sign-up.
- Two-Factor Authentication: Adding an extra layer of security for user authentication.
- Search and Filter: Enhancing the notes management with advanced search and filtering options.
- Password recovery system.

## Contributor:
Contributor: tanvir Mahamood. <br>
Email: `deltatanvir2002@gmail.com`

