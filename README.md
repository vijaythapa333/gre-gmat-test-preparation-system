# GRE GMAT Test Preparation System
GRE/GMAT Online Test Preparation System developed for an Educational Institute of Nepal.

And if you like this project then ADD a STAR ⭐️  to this project 👆

## Technologies Used
1. Front-End (HTML5, CSS3, JS)
2. Backend (PHP OOP)
3. Database (MySQLi)

## Features of this Project

### A. Users (Students) Can 


### B. Admins Can

1. Manage Admins
2. Manage Students
3. Manage Questions
4. Manage Facculties
5. One-Time Exam for Students
6. On-The-Spot Result Generation (Score)
7. Display the Wright and Wrong Answers with Detail Reasons.


## Support Developer
1. Subscribe & Share my YouTube Channel - https://bit.ly/vijay-thapa-online-courses
2. Add a Star 🌟  to this 👆 Repository



## How to Install and Run this project?

### Pre-Requisites:

1. Download and Install XAMPP

[Click Here to Download](https://www.apachefriends.org/index.html)

2. Install any Text Editor (Sublime Text or Visual Studio Code or Atom or Brackets)

### Installtion

1. Download as as Zip or Clone this project
2. Extract and Move this project to Root Directory
```
Local Disc C: -> xampp -> htdocs -> 'this project'
```
*Local Disk C is the location where xampp was installed*

3. Open XAMPP Control Panel and Start 'Apache' and 'MySQL'

4. Extract and Import Database

a. Open 'phpmyadmin' in your browser
b. Create a Database ('mlb2018')
c. Import the SQL file provided with this project ('mlb2018')

5. Make Changes to settings

Go to 'admin' folder then'config' folder and Open 'constants.php' file. Then make changes on following constants
```php
<?php 
//Start Session
session_start();

//Create Constants to save Database Credentials
define('LOCALHOST', 'localhost');
define('USERNAME', 'root'); //Your Database username instead of 'root'
define('PASSWORD', ''); //Your Database Password instead of null/empty
define('DBNAME', 'mlb2018'); //Your Database Name if it's not 'mlb2018'

define('SITEURL', 'http://localhost/phpmultilingualblog/'); //Update the home URL of the project if you have changed port number or it's live on server

?>
```

6. Now, Open the project in your browser. It should run perfectly.


## CMS - Admin Panel
This is a very simple Content Management System (No advanced stuffs). 

**Instructions to use**
1. Go to the link -> yourhomeurl/admin  
>e.g. *http://localhost:81/phpmultilingualblog/admin*
2. Login with the Username and Password 
>*[Username: admin, Password: admin]*
3. Hola! You're logged in. Now you can manage categories, posts and users.


## For Sponsor or Projects Enquiry
1. Email - hi@vijaythapa.com
2. LinkedIn - [vijaythapa](https://www.linkedin.com/in/vijaythapa "Vijay Thapa on LinkedIn")


## FREE Software Development Courses at
http://bit.ly/VijayThapaYouTube
