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
        $stmt=$mysqli->prepare( "select * from users where username = ?");
        if($stmt){
            $stmt->bind_param("s",$username);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows>0)
                return false;
            else
                return true;
        }
        else{
            die("some error happened :".$stmt->error);
        }
        return false;
    }
    function uniqueEmail($email){
        global $mysqli;
        $stmt=$mysqli->prepare( "select * from users where email=?");
        if($stmt){
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows>0)
                return false;
            else
                return true;
        }
        else{
            die("some error happened :".$stmt->error);
        }
        return false;
    }
    function getUserInformation($username){
        global $mysqli;
        $stmt=$mysqli->prepare( "select * from users where username = ?");
        if($stmt){
            $stmt->bind_param("s",$username);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows>0)
                return false;
            else
                return true;
        }
        else{
            die("some error happened :".$stmt->error);
        }
        return false;
    }
    function getBankAccountId($username){
        
    }

?>