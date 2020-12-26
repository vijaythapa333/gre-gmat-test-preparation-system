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
                   $fifth_answer=$row['fifth_answer'];
                   $answer=$row['answer'];
                   $reason=$row['reason'];
                   $marks=$row['marks'];
                   $category=$row['category'];
                   $faculty_db=$row['faculty'];
                   $is_active=$row['is_active'];
                   $previous_image=$row['image_name'];
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
                    
                    <form method="post" action="" class="forms" enctype="multipart/form-data">
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
                        <span class="name">Question</span><br />
                        <textarea name="question" required="true"><?php echo $question; ?></textarea> <br />
                        <script>
                            CKEDITOR.replace( 'question' );
                        </script>
                        
                        <?php 
                            if($previous_image!="")
                            {
                                ?>
                                <span class="name">Previous Image</span>
                                <img src="<?php echo SITEURL; ?>images/questions/<?php echo $previous_image; ?>" /> <br />
                                <?php
                            }
                        ?>
                        <input type="hidden" name="previous_image" value="<?php echo $previous_image; ?>" />
                        
                        <span class="name">New Image</span>
                        <input type="file" name="image" /><br />
                        
                        <span class="name">First Answer</span>
                        <input type="text" name="first_answer" value="<?php echo $first_answer;; ?>" required="true" /><br />
                        
                        <span class="name">Second Answer</span>
                        <input type="text" name="second_answer" value="<?php echo $second_answer; ?>" required="true" /><br />
                        
                        <span class="name">Third Answer</span>
                        <input type="text" name="third_answer" value="<?php echo $third_answer; ?>" required="true" /><br />
                        
                        <span class="name">Fourth Answer</span>
                        <input type="text" name="fourth_answer" value="<?php echo $fourth_answer; ?>" required="true" /><br />
                        
                        <span class="name">Fifth Answer</span>
                        <input type="text" name="fifth_answer" value="<?php echo $fifth_answer; ?>" required="true" /><br />
                        
                        
                        <span class="name">Answer</span>
                        <select name="answer">
                            <option <?php if($answer==1){echo "selected='seleccted'";} ?> value="1">First Answer</option>
                            <option <?php if($answer==2){echo "selected='seleccted'";} ?> value="2">Second Answer</option>
                            <option <?php if($answer==3){echo "selected='seleccted'";} ?> value="3">Third Answer</option>
                            <option <?php if($answer==4){echo "selected='seleccted'";} ?> value="4">Fourth Answer</option>
                            <option <?php if($answer==5){echo "selected='seleccted'";} ?> value="5">Fifth Answer</option>
                        </select>
                        <br />
                        
                        <span class="name">Reason</span><br />
                        <textarea name="reason" ><?php echo $reason; ?></textarea>
                        <script>
                            CKEDITOR.replace( 'reason' );
                        </script>
                        <br />
                        
                        <span class="name">Marks</span>
                        <input type="text" name="marks" value="<?php echo $marks; ?>" />
                        <br />
                        
                        <span class="name">Category</span>
                        <select name="category">
                            <option <?php if($category=="English"){echo "selected='seleccted'";} ?> value="English">English</option>
                            <option  <?php if($category=="Math"){echo "selected='seleccted'";} ?> value="Math">Math</option>
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
                            $fifth_answer=$obj->sanitize($conn,$_POST['fifth_answer']);
                            $answer=$obj->sanitize($conn,$_POST['answer']);
                            $reason=$obj->sanitize($conn,$_POST['reason']);
                            $marks=$obj->sanitize($conn,$_POST['marks']);
                            $category=$obj->sanitize($conn,$_POST['category']);
                            $faculty=$obj->sanitize($conn,$_POST['faculty']);
                            $previous_image=$_POST['previous_image'];
                            if(isset($_POST['is_active']))
                            {
                                $is_active=$_POST['is_active'];
                            }
                            else
                            {
                                $is_active="yes";
                            }
                            $updated_date=date('Y-m-d');
                            //Managing Question Images
                            if($_FILES['image']['name']!="")
                            {
                                //echo "Book Cover is Available";
                                //Getting File Extension
                                $ext=end(explode('.',$_FILES['image']['name']));
                                //Checking if the file type is valid or not
                                $valid_file=$obj->check_image_type($ext);
                                if($valid_file==false)
                                {
                                    $_SESSION['invalid']="<div class='error'>Invalid Image type. Please use JPG or PNG or GIF file type.</div>";
                                    header('location:'.SITEURL.'admin/index.php?page=update_question&id='.$question_id);
                                    die();
                                }
                                //Removing Previous Image
                                if($previous_image!="")
                                {
                                    $path="../images/questions/".$previous_image;
                                    $remove=$obj->remove_file($path);
                                    if($remove==false)
                                    {
                                        $_SESSION['remove_book']="Failed to remove previous Image. Try again.";
                                        header('location:'.SITEURL.'admin/index.php?page=update_question&id='.$question_id);
                                        die();
                                    }
                                }
                                //Uploading if the file is valid
                                //first changing image name
                                $new_name='Exam_Question_Vijay_Thapa_'.$obj->uniqid();
                                $image_name=$new_name.'.'.$ext;
                                //Adding Watermark to the image fie too
                                $source=$_FILES['image']['tmp_name'];
                                $destination="../images/questions/".$image_name;
                                $upload=$obj->upload_file($source,$destination);
                                if($upload==false)
                                {
                                    $_SESSION['upload']="<div class='error'>Failed to upload question image. Try again.</div>";
                                    header('location:'.SITEURL.'admin/index.php?page=update_question&id='.$question_id);
                                    die();
                                }
                            }
                            else
                            {
                                $image_name=$previous_image;
                            }
                            
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
                                    fifth_answer='$fifth_answer',
                                    answer='$answer',
                                    reason='$reason',
                                    marks='$marks',
                                    category='$category',
                                    faculty='$faculty',
                                    is_active='$is_active',
                                    updated_date='$updated_date',
                                    image_name='$image_name'
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