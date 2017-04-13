<?php 
    include('check.php');
    $tbl_name4="tbl_student";
    $username=$_SESSION['student'];
    $where4="username='$username'";
    $query4=$obj->select_data($tbl_name4,$where4);
    $res4=$obj->execute_query($conn,$query4);
    if($res4==true)
    {
        $row4=$obj->fetch_data($res4);
        $student_id=$row4['student_id'];
        $first_name=$row4['first_name'];
        $last_name=$row4['last_name'];
        $faculty=$row4['faculty'];
        $full_name=$first_name.' '.$last_name;
    }
?>
<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                
                User: <span class="heavy"><?php echo $full_name; ?></span>
                <form method="post" action="">
                    <div class="welcome">
                        <div class="ques">
                        <?php 
                            
                            if(!isset($_SESSION['all_qns']))
                            {
                                $_SESSION['all_qns']=0;
                            }
                            
                            
                            $tbl_name="tbl_question";
                            //New Query
                            $where="is_active='yes' && question_id NOT IN (".$_SESSION['all_qns'].")";
                            //Old Query
                            //$where="is_active='yes'";
                            $limit=1;
                            $query=$obj->select_random_row($tbl_name,$where,$limit);
                            $res=$obj->execute_query($conn,$query);
                            if($res==true)
                            {
                                $count_rows=$obj->num_rows($res);
                                if($count_rows>0)
                                {
                                    $row=$obj->fetch_data($res);
                                    $question_id=$row['question_id'];
                                    //Check if the question is answered or not
                                    
                                    $question=$row['question'];
                                    $first_answer=$row['first_answer'];
                                    $second_answer=$row['second_answer'];
                                    $third_answer=$row['third_answer'];
                                    $fourth_answer=$row['fourth_answer'];
                                    $answer=$row['answer'];
                                }
                                else
                                {
                                    //echo "Error";
                                    header('location:'.SITEURL.'index.php?page=endSession');
                                }
                            }
                            //Checking ALl Answered Questions
                            
                        ?>
                        <form method="post" action="">
                            <?php 
                            if(!isset($_SESSION['sn']))
                            {
                                $_SESSION['sn']=1;
                                echo $_SESSION['sn'];
                            }
                            else
                            {
                                echo $_SESSION['sn'];
                            } 
                            //Set the total number of questions per set
                            if($_SESSION['sn']>3)
                            {
                                header('location:'.SITEURL.'index.php?page=endSession');
                            }
                            ?>. 
                                <?php echo $question; ?> <br /><br />
                            <input type="radio" name="answer" value="1" /> <span class="radio-ans"><?php echo $first_answer; ?></span>  <hr />
                            <input type="radio" name="answer" value="2" /> <span class="radio-ans"><?php echo $second_answer; ?></span> <hr />
                            <input type="radio" name="answer" value="3" /> <span class="radio-ans"><?php echo $third_answer; ?></span>  <hr />
                            <input type="radio" name="answer" value="4" /> <span class="radio-ans"><?php echo $fourth_answer; ?> <hr /><br />&nbsp;
                            <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                            <input type="hidden" name="right_answer" value="<?php echo $answer; ?>" />
                            <input type="submit" name="submit" value="Submit and Next" class="btn-go" />
                            
                            <a href="<?php echo SITEURL; ?>index.php?page=logout">
                                <button type="button" class="btn-exit">&nbsp; Quit &nbsp;</button>
                            </a>
                        </form>
                        <?php 
                            if(isset($_POST['submit']))
                            {
                                //echo "Clicked";
                                //Get the details from the form
                                $question_id=$_POST['question_id'];
                                
                                //Submitting Answers to the database
                                if(isset($_POST['answer']))
                                {
                                    $user_answer=$obj->sanitize($conn,$_POST['answer']);
                                }
                                else
                                {
                                    $user_answer=0;
                                }
                                $right_answer=$obj->sanitize($conn,$_POST['right_answer']);
                                $question_id=$obj->sanitize($conn,$_POST['question_id']);
                                $username=$_SESSION['student']; 
                                //Get User ID from username
                                $tbl_name="tbl_student";
                                $student_id=$obj->get_userid($tbl_name,$username,$conn);
                                $added_date=date('Y-m-d');
                                //Now Adding Data to Database
                                $tbl_name="tbl_result";
                                $data="
                                student_id='$student_id',
                                question_id='$question_id',
                                user_answer='$user_answer',
                                right_answer='$right_answer',
                                added_date='$added_date'
                                ";
                                if(isset($_SESSION['totalScore']))
                                {
                                    $totalScore=$_SESSION['totalScore'];
                                }
                                else
                                {
                                    $totalScore=0;
                                }
                                
                                if($user_answer==$right_answer)
                                {
                                    $_SESSION['totalScore']=$totalScore+1;
                                }
                                else
                                {
                                    $_SESSION['totalScore']=$totalScore-1;
                                }
                                $query=$obj->insert_data($tbl_name,$data);
                                //$res=true;
                                $res=$obj->execute_query($conn,$query);
                                if($res===true)
                                {
                                    //adding all the questions in session variable
                                    if(isset($_SESSION['all_qns']))
                                    {
                                        $_SESSION['all_qns']=$_SESSION['all_qns'].','.$question_id;
                                    }
                                    else
                                    {
                                        $_SESSION['all_qns']=0;
                                    }
                                    //Save the answer for result
                                    if(isset($_SESSION['sn']))
                                    {
                                        $_SESSION['sn']=$_SESSION['sn']+1;
                                    }
                                    else
                                    {
                                        $_SESSION['sn']=1;
                                    }
                                    
                                    $_SESSION['qns']=$question_id;
                                    //Redirect to the question page
                                    header('location:'.SITEURL.'index.php?page=question');
                                }
                                else
                                {
                                    echo "Error";
                                }
                                
                            }
                        ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--Body Ends Here-->