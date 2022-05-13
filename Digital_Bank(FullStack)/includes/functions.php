<?php 
    include 'db.php';
    
    function test_input($data) {
        global $mysqli;
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data =$mysqli->real_escape_string($data);
        return $data;
    }
    function uniqueUsername($username){
        global $mysqli;
        $str="select * from users where username=";
        $str.=$username;
        $result=$mysqli->query($str);
        if(mysqli_num_rows($result)>0)
            return false;
        else
            return true;
    }
    function uniqueEmail($email){
        global $mysqli;
        $str="select * from users where email=";
        $str.=$email;
        $result=$mysqli->query($str);
        if($result->num_rows>0)
            return false;
        else 
            return true;
    }

?>