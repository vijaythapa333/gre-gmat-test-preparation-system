# GRE GMAT Test Preparation System
GRE/GMAT Online Test Preparation System developed for an Educational Institute of Nepal.

And if you like this project then ADD a STAR ⭐️  to this project 👆

## Technologies Used
1. Front-End (HTML5, CSS3, JS)
2. Backend (PHP - OOP)
3. Database (MySQLi)

## Features of this Project

### A. Users (Students) Can 

1. Take Exams (Username & Password provided by Admin)
2. After login, Student will see the "Rules for Taking Exam"
3. After the exam is completed, you will get the results immediately and can also check the detail result view **(*You can see the answers you've selected to the questions and can also see the reason for that answer to be right.*).**

**Rules are**
1. Once you click on "Take Exam" button, the exam will begin and count down begins
2. Questions are selected randomly **(*If a student gets a question on no.1, another student might get the same question on different position or might not get the question at all*)**
3. You'll have to select an option and click on "Next" button to get another question.
4. You cannot go back to the previous question, Once 'Next' button is clicked.
5. If you close the window or click on "Quit" button, the session will be completed and you will be logged out. Then you won't have permission to log in again and take the exam. **(*You'll have to contact administrators to grant you permission to take the exam again*).**


### B. Admins Can

1. Manage Admin Credentials 
2. Manage Students (Create New, Update and Delete Existing Ones)
3. Manage Questions 
4. Manage Faculties
5. Manage the Results of the Students.
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

- Open 'phpmyadmin' in your browser
- Create a Database ('quizapp')
- Import the SQL file provided with this project ('quizapp')

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
define('DBNAME', 'quizapp'); //Your Database Name if it's not 'quizapp'

define('SITEURL', 'http://localhost/name_of_project_folder/'); //Update the home URL of the project if you have changed port number or it's live on server

?>
```

6. Now, Open the project in your browser. It should run perfectly.


## CMS - Admin Panel
This is a very simple Content Management System (No advanced stuffs). 

**Instructions to use**
1. Go to the link -> yourhomeurl/admin  
>e.g. *http://localhost:81/name-of-project-folder/admin*
2. Login with the Username and Password 
>*[Username: admin, Password: admin]*
3. Hola! You're logged in. Now you can manage categories, posts and users.


## Project Limitation & Strategy to make it Successful 
[Click Here for Detail Report](https://www.linkedin.com/pulse/why-projects-fail-vijay-thapa/ "Strategies to Make your project successful.")


## For Sponsor or Projects Enquiry
1. Email - hi@vijaythapa.com
2. LinkedIn - [vijaythapa](https://www.linkedin.com/in/vijaythapa "Vijay Thapa on LinkedIn")


## FREE Software Development Courses at
http://bit.ly/VijayThapaYouTube
