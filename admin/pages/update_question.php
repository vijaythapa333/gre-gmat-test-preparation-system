<!--Body Starts Here-->
        <?php 
            if(isset($_GET['id']))
            {
                $question_id=$_GET['id'];
                $tbl_name='tbl_question';
                $where="question_id=$question_id";
                $query=$obj->select_data($tbl_name,$where);
                $res=$obj->execute_query($conn,$query);
                $count_rows=$obj->num_rows($res);
                if($count_rows==1)
                {
                    $row=$obj->fetch_data($res);
                   $question=$row['question'];
                   $first_answer=$row['first_answer'];
                   $second_answer=$row['second_answer'];
                   $third_answer=$row['third_answer'];
                   $fourth_answer=$row['fourth_answer'];
                   $answer=$row['answer'];
                   $faculty_db=$row['faculty'];
                   $is_active=$row['is_active'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/index.php?page=questions');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/index.php?page=questions');
            }
        ?>
        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Update Question</h2>
                        <?php 
                            if(isset($_SESSION['validation']))
                            {
                                echo $_SESSION['validation'];
                                unset($_SESSION['validation']);
                            }
                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
                        ?>
                        <span class="name">Question</span>
                        <textarea name="question" required="true"><?php echo $question; ?></textarea> <br />
                        
                        <span class="name">First Answer</span>
                        <input type="text" name="first_answer" value="<?php echo $first_answer;; ?>" required="true" /><br />
                        
                        <span class="name">Second Answer</span>
                        <input type="text" name="second_answer" value="<?php echo $second_answer; ?>" required="true" /><br />
                        
                        <span class="name">Third Answer</span>
                        <input type="text" name="third_answer" value="<?php echo $third_answer; ?>" required="true" /><br />
                        
                        <span class="name">Fourth Answer</span>
                        <input type="text" name="fourth_answer" value="<?php echo $fourth_answer; ?>" required="true" /><br />
                        
                        
                        <span class="name">Answer</span>
                        <select name="answer">
                            <option <?php if($answer==1){echo "selected='seleccted'";} ?> value="1">First Answer</option>
                            <option <?php if($answer==2){echo "selected='seleccted'";} ?> value="2">Second Answer</option>
                            <option <?php if($answer==3){echo "selected='seleccted'";} ?> value="3">Third Answer</option>
                            <option <?php if($answer==4){echo "selected='seleccted'";} ?> value="4">Fourth Answer</option>
                        </select>
                        <br />
                        
                        <span class="name">Faculty</span>
                        <select name="faculty">
                             <?php 
                                //Get Faculties from database
                                $tbl_name="tbl_faculty";
                                $query=$obj->select_data($tbl_name);
                                $res=$obj->execute_query($conn,$query);
                                $count_rows=$obj->num_rows($res);
                                if($count_rows>0)
                                {
                                    while($row=$obj->fetch_data($res))
                                    {
                                        $faculty_id=$row['faculty_id'];
                                        $faculty_name=$row['faculty_name'];
                                        ?>
                                        <option <?php if($faculty_db==$faculty_id){echo"selected='selected'";} ?> value="<?php echo $faculty_id; ?>"><?php echo $faculty_name; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">Uncategorized</option>
                                    <?php
                                }
                            ?>
                        </select>
                        <br />
                        
                        <span class="name">Is Active?</span>
                        <input <?php if($is_active=='yes'){echo "checked='checked'";} ?> type="radio" name="is_active" value="yes" /> Yes 
                        <input <?php if($is_active=='no'){echo "checked='checked'";} ?> type="radio" name="is_active" value="no" /> No
                        <br />
                        
                        <input type="submit" name="submit" value="Update Question" class="btn-update" style="margin-left: 15%;" />
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=questions"><button type="button" class="btn-delete">Cancel</button></a>
                    </form>
                    <?php 
                        if(isset($_POST['submit']))
                        {
                            //echo "Clicked";
                            $question=$obj->sanitize($conn,$_POST['question']);
                            $first_answer=$obj->sanitize($conn,$_POST['first_answer']);
                            $second_answer=$obj->sanitize($conn,$_POST['second_answer']);
                            $third_answer=$obj->sanitize($conn,$_POST['third_answer']);
                            $fourth_answer=$obj->sanitize($conn,$_POST['fourth_answer']);
                            $answer=$obj->sanitize($conn,$_POST['answer']);
                            $faculty=$obj->sanitize($conn,$_POST['faculty']);
                            if(isset($_POST['is_active']))
                            {
                                $is_active=$_POST['is_active'];
                            }
                            else
                            {
                                $is_active="yes";
                            }
                            $updated_date=date('Y-m-d');
                            
                            //Normal PHP Validation
                            if(($question==null)or($first_answer==null)or($second_answer==null)or($third_answer==null)or($fourth_answer==null)or($answer==null))
                            {
                                $_SESSION['validation']="<div class='error'>Either Question or One of the Answers field is empty.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=update_question&id='.$question_id);
                            }
                            //Updating Question
                            $tbl_name="tbl_question";
                            $data="
                                    question='$question',
                                    first_answer='$first_answer',
                                    second_answer='$second_answer',
                                    third_answer='$third_answer',
                                    fourth_answer='$fourth_answer',
                                    answer='$answer',
                                    faculty='$faculty',
                                    is_active='$is_active',
                                    updated_date='$updated_date'
                            ";
                            $where="question_id='$question_id'";
                            $query=$obj->update_data($tbl_name,$data,$where);
                            $res=$obj->execute_query($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['update']="<div class='success'>Question successfully updated.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=questions');
                            }
                            else
                            {
                                $_SESSION['update']="<div class='error'>Failed to update question.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=update_question&id='.$question_id);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <!--Body Ends Here-->