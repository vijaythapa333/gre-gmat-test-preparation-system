<?php 
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
    else
    {
        $page='welcome';
    }
    
    switch($page)
    {
        case "welcome":
        {
            include('welcome.php');
        }
        break;
        
        case "question":
        {
            include('question.php');
        }
        break;
        
        case "login":
        {
            include('login.php');
        }
        break;
        
        case "endSession":
        {
            include('endSession.php');
        }
        break;
        
        case "detail_result":
        {
            include('detail_result.php');
        }
        break;
        
        case "logout":
        {
            /*
            if(isset($_SESSION['totalScore']))
            {
                $totalScore=$_SESSION['totalScore'];
            }
            else
            {
                $totalScore=0;
            }
            //To get student id from student username
            $tbl_name="tbl_student";
            $username=$_SESSION['student'];
            $student_id=$obj->get_userid($tbl_name,$username,$conn);
            //to add sesult summary to the database
            $added_date=date('Y-m-d');
            $tbl_name2="tbl_result_summary";
            $data="student_id='$student_id',
                    marks='$totalScore',
                    added_date='$added_date'
                    ";
            $query=$obj->insert_data($tbl_name2,$data);
            $res=$obj->execute_query($conn,$query);
            */
            $tbl_name="tbl_student";
            $username=$_SESSION['student'];
            $student_id=$obj->get_userid($tbl_name,$username,$conn);
            $res=true;
            if($res==true)
            {
                //Setting Student Is_Active Mode to No
                $tbl_name3="tbl_student";
                $data3="is_active='no'";
                $where3="student_id='$student_id'";
                $query3=$obj->update_data($tbl_name3,$data3,$where3);
                $res3=$obj->execute_query($conn,$query3);
                if($res3===true)
                {
                    session_destroy();
                    header('location:'.SITEURL.'index.php?page=login');
                }
                else
                {
                    echo "Error";
                }
                
            }
            else
            {
                echo "Error";
            }
            
        }
        break;
        
        default:
        {
            include('welcome.php');
        }
        break;
    }
?>