<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                
                User: <span class="heavy"><?php echo $_SESSION['user']; ?></span>
                <form method="post" action="">
                    <div class="welcome">
                        <?php 
                            //To print all the answered questions
                            if(isset($_SESSION['ques']))
                            {
                                print_r($_SESSION['ques']);
                            }
                            
                            $tbl_name="tbl_question";
                            $where="is_active='yes'";
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
                                    if(isset($_SESSION['ques']))
                                    {
                                        if(in_array($question_id,$_SESSION['ques']))
                                        {
                                            //echo "Answered";
                                            header('location:'.SITEURL.'index.php?page=question');
                                        }
                                    }
                                    /*if(in_array($question_id,$answered_questions))
                                    {
                                        echo("Answered");
                                    }*/
                                    $question=$row['question'];
                                    $first_answer=$row['first_answer'];
                                    $second_answer=$row['second_answer'];
                                    $third_answer=$row['third_answer'];
                                    $fourth_answer=$row['fourth_answer'];
                                    $answer=$row['answer'];
                                }
                            }
                        ?>
                        <form method="post" action="">
                            1. <?php echo $question; ?> <br />
                            <input type="radio" name="question" value="<?php echo $first_answer; ?>" /> <?php echo $first_answer; ?>  &nbsp;
                            <input type="radio" name="question" value="<?php echo $second_answer; ?>" /> <?php echo $second_answer; ?> &nbsp;
                            <input type="radio" name="question" value="<?php echo $third_answer; ?>" /> <?php echo $third_answer; ?>  &nbsp;
                            <input type="radio" name="question" value="<?php echo $fourth_answer; ?>" /> <?php echo $fourth_answer; ?> <br />&nbsp;
                            <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
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
                                //To add the answered questions in an array
                                if(isset($_SESSION['ques']))
                                {
                                    array_push($_SESSION['ques'],$question_id);
                                }
                                else
                                {
                                    $_SESSION['ques']=array($question_id);
                                }
                                
                                //Save the answer for result
                                
                                $_SESSION['qns']=$question_id;
                                //Redirect to the question page
                                header('location:'.SITEURL.'index.php?page=question');
                            }
                        ?>
                    </div>
                </form>
            </div>
        </div>
        <!--Body Ends Here-->