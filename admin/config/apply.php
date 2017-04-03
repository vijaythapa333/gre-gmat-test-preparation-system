<?php 
     //Start Session Here
    session_start();
    include('functions.php');
    $obj=new Functions();
    //Connecting to Database
    $conn=$obj->db_connect();
    //SElecting Database
    $db_select=$obj->db_select($conn);
?>