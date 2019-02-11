<?php 
    include('check.php');
    include('pages/timeCheck.php');
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
    //get total time and total no. of questions based on the faculty of the student
    $tbl_name_qns='tbl_faculty';
    $where_qns="faculty_id='$faculty'";
    $query_qns=$obj->select_data($tbl_name_qns,$where_qns);
    $res_qns=$obj->execute_query($conn,$query_qns);
    if($res_qns==true)
    {
        $row_qns=$obj->fetch_data($res_qns);
        $faculty_name=$row_qns['faculty_name'];
        $_SESSION['facultyName']=$faculty_name;
        $time_duration=$row_qns['time_duration'];
        $totalTime=$time_duration*60;
        $qns_per_page=$row_qns['qns_per_set'];
        $total_english=$row_qns['total_english'];
        
        //echo $total_english;die();
    }
    if(!isset($_SESSION['strt_time']))
    {
        $_SESSION['strt_time']=date('h:i:s A');
    }
    if(!isset($_SESSION['end_time']))
    {
        $_SESSION['end_time']=date('h:i:s A',strtotime("+".$time_duration." minutes"));
    }
    
    
?>
<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                
                User: <span class="heavy"><?php echo $full_name; ?></span>&nbsp;&nbsp;
                Faculty: <span class="heavy"><?php echo $faculty_name; ?></span>&nbsp;&nbsp;
                Start Time: <span class="heavy"><?php echo $_SESSION['strt_time']; ?></span>&nbsp;&nbsp;
                End Time: <span class="heavy"><?php echo $_SESSION['end_time']; ?></span>&nbsp;&nbsp;
                <?php 
                    //Getting Time Difference
                    $startTime=strtotime($_SESSION['end_time']);
                    $currentTime=strtotime(date('h:i:s A'));
                    $timeDifference=$startTime-$currentTime;
                    
                ?>
                <span class="timer" data-seconds-left=<?php echo $timeDifference; ?>></span>
                <form method="post" action="">
                    <div class="welcome">
                        <div class="ques">
                        <?php 
                            
                            if(!isset($_SESSION['all_qns']))
                            {
                                $_SESSION['all_qns']=0;
                            }
                            
                            if(isset($_SESSION['sn']))
                            {
                                $sn=$_SESSION['sn'];
                            }
                            else
                            {
                                $sn=0;
                            }
                            $tbl_name="tbl_question";
                            
                            //Get English Questions Only
                            if($sn<=$total_english)
                            {
                                //New Query FOR ENGLISH
                                $where="is_active='yes' && category='English' && faculty='".$faculty."' && question_id NOT IN (".$_SESSION['all_qns'].")";
                            }
                            else
                            {
                                //New Query FOR MATHS
                                $where="is_active='yes' && category='Math' && faculty='".$faculty."' && question_id NOT IN (".$_SESSION['all_qns'].")";
                            }
                            //Get Maths Questions Only
                            //New Query
                            //$where="is_active='yes' && faculty='".$faculty."' && question_id NOT IN (".$_SESSION['all_qns'].")";
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
                                    $fifth_answer=$row['fifth_answer'];
                                    $answer=$row['answer'];
                                    $marks=$row['marks'];
                                    $image_name=$row['image_name'];
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
                            <!--Question Starts Here-->
                            <div class="left-ques">
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
                            if($_SESSION['sn']>$qns_per_page)
                            {
                                header('location:'.SITEURL.'index.php?page=endSession');
                            }
                            ?>. 
                            
                                <?php echo $question; ?><br />
                                <?php 
                                    if($image_name!="")
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/questions/<?php echo $image_name; ?>" alt="beyond boundaries" />
                                        <?php
                                    }
                                ?>
                                
                            </div>
                            <!--Question Ends Here-->
                            
                            <!--Answer Starts Here-->
                            <div class="answers">
                                <input type="radio" name="answer" value="1" required="true" /> <span class="radio-ans"><?php echo $first_answer; ?></span>  <hr /><br />
                                <input type="radio" name="answer" value="2" required="true" /> <span class="radio-ans"><?php echo $second_answer; ?></span> <hr /><br />
                                <input type="radio" name="answer" value="3" required="true" /> <span class="radio-ans"><?php echo $third_answer; ?></span>  <hr /><br />
                                <input type="radio" name="answer" value="4" required="true" /> <span class="radio-ans"><?php echo $fourth_answer; ?></span>  <hr /><br />
                                <input type="radio" name="answer" value="5" required="true" /> <span class="radio-ans"><?php echo $fifth_answer; ?> <hr /><br />&nbsp;
                                <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                                <input type="hidden" name="right_answer" value="<?php echo $answer; ?>" />
                                <input type="hidden" name="marks" value="<?php echo $marks; ?>" />
                            </div>
                            <!--Answer Ends Here-->
                            <div class="clearfix"></div>
                            <!--
                                <?php echo $question; ?> <br /><br />
                            <input type="radio" name="answer" value="1" /> <span class="radio-ans"><?php echo $first_answer; ?></span>  <hr />
                            <input type="radio" name="answer" value="2" /> <span class="radio-ans"><?php echo $second_answer; ?></span> <hr />
                            <input type="radio" name="answer" value="3" /> <span class="radio-ans"><?php echo $third_answer; ?></span>  <hr />
                            <input type="radio" name="answer" value="4" /> <span class="radio-ans"><?php echo $fourth_answer; ?> <hr /><br />&nbsp;
                            <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                            <input type="hidden" name="right_answer" value="<?php echo $answer; ?>" />
                            -->
                            <div class="buttons">
                                <input type="submit" name="submit" value="Submit and Next" class="btn-go" />
                                
                                <a href="<?php echo SITEURL; ?>index.php?page=logout">
                                    <button type="button" class="btn-exit">&nbsp; Quit &nbsp;</button>
                                </a>
                            </div>
                        </form>
                        <?php 
                            if(isset($_POST['submit']))
                            {
                                //echo "Clicked";
                                //CHeck if the answer is clicked or not
                                
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
                                $marks=$_POST['marks'];
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
                                //CHeck if the total score is set or not
                                if(isset($_SESSION['totalScore']))
                                {
                                    $totalScore=$_SESSION['totalScore'];
                                }
                                else
                                {
                                    $totalScore=0;
                                }
                                
                                //Check if the full marks is set or not
                                if(isset($_SESSION['full_marks']))
                                {
                                    $full_marks=$_SESSION['full_marks'];
                                }
                                else
                                {
                                    $full_marks=0;
                                }
                                
                                if($user_answer==$right_answer)
                                {
                                    $_SESSION['totalScore']=$totalScore+$marks;
                                    $_SESSION['full_marks']=$full_marks+$marks;
                                }
                                else
                                {
                                    $_SESSION['totalScore']=$totalScore+0;
                                    $_SESSION['full_marks']=$full_marks+$marks;
                                }
                                $query=$obj->insert_data($tbl_name,$data);
                                //$res=true;
                                $res=$obj->execute_query($conn,$query);
                                if($res===true)
                                {
                                    //Time Validation
                                    
                                    /*echo $current_time; 
                                    if($current_time==$current_time)
                                    {
                                        echo "Okey"; die();
                                    }*/
                                    /*$start=strtotime($current_time);
                                    $end=strtotime($_SESSION['end_time']);
                                    if($start>$end)
                                    {
                                        $_SESSION['time_complete']="<div class='error'>Your exam time has ended. Thank You.</div>";
                                        header('location:'.SITEURL.'index.php?page=endSession');
                                        echo "session end";die();
                                    }*/
                                    include('pages/timeCheck.php');
                                    /*
                                    if($current_time>$_SESSION['end_time'])
                                    {
                                        $_SESSION['time_complete']="<div class='error'>Your exam time has ended. Thank You.</div>";
                                        header('location:'.SITEURL.'index.php?page=endSession');
                                    }
                                    */
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