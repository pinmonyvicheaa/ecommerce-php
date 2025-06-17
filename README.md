# E-Commerce PHP with PDO

This E-Commerce project is an online shop using PHP and PDO for database operations, featuring products, admin, login ..etc.

# Installation:

Step 1: Install Required Tools

- Make sure you have:
```
+ XAMPP: https://www.apachefriends.org/download
+ Git: https://git-scm.com/downloads
```

Step 2: Clone the Project
```
cd C:\xampp\htdocs
git clone https://github.com/pinmonyvicheaa/ecommerce-php.git
```

Step 3: Start Apache and MySQL
```
1. Open XAMPP Control Panel
2. Click Start next to Apache and MySQL
```

Step 4: Import the Database

```
1. Open your browser and go to: http://localhost/phpmyadmin
2. Click New on the left sidebar and create a database name: myproject
3. Click the myproject DB → Go to Import
4. Click Choose File and select the .sql file from the project folder (in database/myproject.sql)
5. Click Go to import
```

Step 5: Configure Database Connection

- Look for a config file: commonly named config.php in a folder database/.
  
1. Open the project folder (C:\xampp\htdocs\ecommerce-php)
2. Find and edit the file with DB config. Example:
```
// Example: config.php
$host = 'localhost';  // Change this to your database host
$dbname = 'myproject'; // Database name
$username = 'root';    // Database username
$password = '';        // XAMPP default has no password
```

Step 6: Run the Project

```
http://localhost/ecommerce-php
```
