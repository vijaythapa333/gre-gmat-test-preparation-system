<?php 
    include('database.php');
    
    class Functions extends Database
    {
        function uniqid()
        {
            $uniq= md5(uniqid(rand(0000,9999),TRUE));
            return $uniq;
        }
        public function sanitize($conn,$data)
        {
            $clean=mysqli_real_escape_string($conn,$data);
            return $clean;
        }
    }
?>