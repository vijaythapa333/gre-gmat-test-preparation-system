<?php 
    if(!isset($_SESSION['user']))
    {
        header('location:'.SITEURL.'index.php?page=login');
;    }
?>