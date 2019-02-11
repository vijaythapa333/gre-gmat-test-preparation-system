<?php 
    if(isset($_SESSION['end_time']))
    {
        
        $current_time=date('h:i:s A');
        $start=strtotime($current_time);
        $end=strtotime($_SESSION['end_time']);
        if($start>$end)
        {
            $_SESSION['time_complete']="<div class='error'>Your exam time has ended. Thank You.</div>";
            header('location:'.SITEURL.'index.php?page=endSession');
            echo "session end";die();
        }
    }
?>