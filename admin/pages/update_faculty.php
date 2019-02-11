<!--Body Starts Here-->
        <?php 
            if(isset($_GET['id']))
            {
                $faculty_id=$_GET['id'];
                //Getting VAlues fro the datadabase
                $tbl_name="tbl_faculty";
                $where="faculty_id=$faculty_id";
                $query=$obj->select_data($tbl_name,$where);
                $res=$obj->execute_query($conn,$query);
                $count_rows=$obj->num_rows($res);
                if($count_rows==1)
                {
                    $row=$obj->fetch_data($res);
                    $faculty_name=$row['faculty_name'];
                    $time_duration=$row['time_duration'];
                    $qns_per_page=$row['qns_per_set'];
                    $total_english=$row['total_english'];
                    $total_math=$row['total_math'];
                    $is_active=$row['is_active'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/index.php?page=faculties');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/index.php?page=faculties');
            }
        ?>
        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Update Faculty</h2>
                        <?php 
                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
                        ?>
                        <span class="name">Faculty Title</span> 
                        <input type="text" name="faculty_name" value="<?php echo $faculty_name; ?>" required="true" /> <br />
                        
                        <span class="name">Time Duration</span>
                        <input type="number" name="time_duration" value="<?php echo $time_duration; ?>" required="true" /><br />
                        
                        <span class="name">Questions/Set</span>
                        <input type="number" name="qns_per_page" value="<?php echo $qns_per_page; ?>" required="true" /><br />
                        
                        <span class="name">Total English Qns</span>
                        <input type="number" name="total_english_qns" value="<?php echo $total_english; ?>" required="true" /><br />
                        
                        <span class="name">Total Math Qns</span>
                        <input type="number" name="total_math_qns" value="<?php echo $total_math; ?>" /><br />
                        
                        <span class="name">Is Active?</span>
                        <input <?php if($is_active=="yes"){echo "checked='checked'";} ?> type="radio" name="is_active" value="yes" /> Yes 
                        <input <?php if($is_active=="no"){echo "checked='checked'";} ?> type="radio" name="is_active" value="no" /> No
                        <br />
                        
                        <input type="submit" name="submit" value="Update Faculty" class="btn-update" style="margin-left: 15%;" />
                        <button type="button" class="btn-delete">Cancel</button>
                    </form>
                    <?php 
                        if(isset($_POST['submit']))
                        {
                            //echo "Clcked";
                            //Getting all the values from the forms
                            $faculty_name=$obj->sanitize($conn,$_POST['faculty_name']);
                            $time_duration=$obj->sanitize($conn,$_POST['time_duration']);
                            $qns_per_page=$obj->sanitize($conn,$_POST['qns_per_page']);
                            $total_english=$obj->sanitize($conn,$_POST['total_english_qns']);
                            $total_math=$obj->sanitize($conn,$_POST['total_math_qns']);
                            $is_active=$obj->sanitize($conn,$_POST['is_active']);
                            $updated_date=date('Y-m-d');
                            
                            $tbl_name='tbl_faculty';
                            $data="faculty_name='$faculty_name',
                                    time_duration='$time_duration',
                                    qns_per_set='$qns_per_page',
                                    total_english='$total_english',
                                    total_math='$total_math',
                                    is_active='$is_active',
                                    updated_date='$updated_date'";
                            $where="faculty_id='$faculty_id'";
                            $query=$obj->update_data($tbl_name,$data,$where);
                            $res=$obj->execute_query($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['update']="<div class='success'>Faculty successfully updated.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=faculties');
                            }
                            else
                            {
                                $_SESSION['update']="<div class='error'>Failed to update faculty. Please try again.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=update_faculty&id='.$faculty_id);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <!--Body Ends Here-->