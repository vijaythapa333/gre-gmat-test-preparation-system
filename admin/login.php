<?php 
    include('config/apply.php');
    include('../box/header.php');
?>

<!--Body Starts Here-->
        <div class="main">
            <div class="login">
                <form method="post" action="">
                    <h2>Admin | Log In</h2>
                    <?php 
                        if(isset($_SESSION['validation']))
                        {
                            echo $_SESSION['validation'];
                            unset($_SESSION['vaidation']);
                        }
                        if(isset($_SESSION['fail']))
                        {
                            echo $_SESSION['fail'];
                            unset($_SESSION['fail']);
                        }
                        if(isset($_SESSION['xss']))
                        {
                            echo $_SESSION['xss'];
                            unset($_SESSION['xss']);
                        }
                    ?>
                    <input type="text" name="username" placeholder="Username" required="true" />
                    <input type="password" name="password" placeholder="Password" required="true" />
                    <input type="submit" name="submit" value="Log In" class="btn-go" />
                    <input type="reset" name="reset" value="Reset" class="btn-exit" />
                </form>
                <?php 
                    if(isset($_POST['submit']))
                    {
                        //echo "Clicked";
                        $username=$obj->sanitize($conn,$_POST['username']);
                        $password_db=md5($obj->sanitize($conn,$_POST['password']));
                        
                        if(($username=="")or($password=""))
                        {
                            $_SESSION['validation']="<div class='error'>Username or Password is Empty</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }
                        $tbl_name="tbl_app";
                        $where="username='$username' AND password='$password_db'";
                        $query=$obj->select_data($tbl_name,$where);
                        $res=$obj->execute_query($conn,$query);
                        $count_rows=$obj->num_rows($res);
                        if($count_rows==1)
                        {
                            $_SESSION['user']=$username;
                            $_SESSION['success']="<div class='success'>Login Successful. Welcome ".$username." to dashboard.</div>";
                            header('location:'.SITEURL.'admin/index.php');
                        }
                        else
                        {
                            $_SESSION['fail']="<div class='error'>Username or Password is invalid. Please try again.</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }
                    }
                ?>
            </div>
        </div>
        <!--Body Ends Here-->

<?php
    include('../box/footer.php');
?>