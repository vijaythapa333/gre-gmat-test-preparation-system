<?php 
    if(!isset($_SESSION['student']))
    {
        header('location:'.SITEURL.'index.php?page=login');
;    }
?>