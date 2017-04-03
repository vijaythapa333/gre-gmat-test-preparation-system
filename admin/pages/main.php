<?php 
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
    else
    {
        $page='home';
    }
    
    switch($page)
    {
        case "home":
        {
            include('dashboard.php');
        }
        break;
        
        case "users":
        {
            include('users.php');
        }
        break;
        
        case "add_user":
        {
            include('add_user.php');
        }
        break;
        
        case "update_user":
        {
            include('add_user.php');
        }
        break;
        
        case "students":
        {
            include('students.php');
        }
        break;
        
        case "add_student":
        {
            include('add_student.php');
        }
        break;
        
        case "update_student":
        {
            include('update_student.php');
        }
        break;
        
        case "categories":
        {
            include('categories.php');
        }
        break;
        
        case "add_category":
        {
            include('add_category.php');
        }
        break;
        
        case "update_category":
        {
            include('update_category.php');
        }
        break;
        
        case "questions":
        {
            include('questions.php');
        }
        break;
        
        case "add_question":
        {
            include('add_question.php');
        }
        break;
        
        case "update_question":
        {
            include('update_question.php');
        }
        break;
        
        case "results":
        {
            include('results.php');
        }
        break;
        
        case "view_result":
        {
            include('view_result.php');
        }
        break;
        
        default:
        {
            include('dashboard.php');
        }
    }
?>