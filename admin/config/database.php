<?php 
    include('constants.php');
    
    Class Database
    {
        public function db_connect()
        {
            $conn=mysqli_connect(LOCALHOST,USERNAME,PASSWORD) or die(mysqli_error());
            return $conn;
        }
        
        public function db_select($conn)
        {
            $db_select=mysqli_select_db($conn,DBNAME) or die(mysqli_error());
            return $db_select;
        }
        public function select_data($tbl_name,$where="",$other="")
        {
            $query="SELECT * FROM $tbl_name";
            if($where!="")
            {
                $query.=" WHERE $where";
            }
            if($other!="")
            {
                $query.=' '.$other;
            }
            return $query;
        }
        public function insert_data($tbl_name,$data)
        {
            $query="INSERT INTO $tbl_name SET $data";
            return $query;
        }
        public function update_data($tbl_name,$data,$where="")
        {
            $query="UPDATE $tbl_name SET $data WHERE $where";
            return $query;
        }
        public function delete_data($tbl_name,$where)
        {
            $query="DELETE FROM $tbl_name WHERE $where";
            return $query;
        }
        public function execute_query($conn,$query)
        {
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            return $res;
        }
        public function num_rows($res)
        {
            $num_rows=mysqli_num_rows($res);
            return $num_rows;
        }
        public function fetch_data($res)
        {
            $row=mysqli_fetch_assoc($res);
            return $row;
        }
        public function check_image_type($ext)
        {
            $valid=array('jpg','png','gif','JPG','PNG','GIF','JPEG');
            if(in_array($ext,$valid))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function check_file_type($ext)
        {
            $valid=array('pdf','docx','ppt','txt');
            if(in_array($ext,$valid))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function upload_file($source,$destination)
        {
            $upload=move_uploaded_file($source,$destination);
            return $upload;
        }
        public function remove_file($path)
        {
            $remove=unlink($path);
            return $remove;
        }
    }
?>