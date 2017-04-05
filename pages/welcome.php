<?php 
    include('check.php');
?>
<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                <div class="welcome">
                    <?php 
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }
                    ?>
                    Hello <span class="heavy"><?php echo $_SESSION['user']; ?></span>. Welcome to Test Preparation Portal.<br />
                    <a href="<?php echo SITEURL; ?>index.php?page=question">
                        <button type="button" class="btn-go">Take a Test</button>
                    </a>
                    <a href="<?php echo SITEURL; ?>index.php?page=logout">
                        <button type="button" class="btn-exit">&nbsp; Quit &nbsp;</button>
                    </a>
                </div>
            </div>
        </div>
        <!--Body Ends Here-->