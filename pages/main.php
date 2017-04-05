<?php 
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
    else
    {
        $page='welcome';
    }
    
    switch($page)
    {
        case "welcome":
        {
            include('welcome.php');
        }
        break;
        
        case "question":
        {
            include('question.php');
        }
        break;
        
        case "login":
        {
            include('login.php');
        }
        break;
        
        case "logout":
        {
            session_destroy();
            header('location:'.SITEURL.'index.php?page=login');
        }
        break;
        
        default:
        {
            include('welcome.php');
        }
        break;
    }
?>