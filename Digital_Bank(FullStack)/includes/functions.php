<?php 
    include 'db.php';
    function getUserId(){
        global $mysqli;
        $getIdStmt=$mysqli->prepare( "select id from users where username= ?");
        $getIdStmt->bind_param("s",$_SESSION["username"]);
        $getIdStmt->execute();
        $getIdStmt->bind_result($resultId);
        $getIdStmt->fetch();
        return $resultId;
    }
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
    function bankAccInf(){
        global $mysqli;
        $stmt=$mysqli->prepare( "select id,interestRate from bankaccount where bankaccount.userId = ?");
        if($stmt){
            $userId=getUserId();
            $stmt->bind_param("s",$userId);
            $stmt->execute();
            $stmt->bind_result($bankAccountId,$interestRate);
            $stmt->fetch();
            return ["id"=>$bankAccountId,"interestRate"=>$interestRate];
        }
        return -1;
    }
    function getCash(){
        global $mysqli;
        $stmt=$mysqli->prepare('select cash from bankaccount where userId=?');
        if($stmt){
            $userId=getUserId();
            $stmt->bind_param("s",$userId);
            $stmt->execute();
            $stmt->bind_result($cash);
            $stmt->fetch();
            return $cash;
        }
        return -1;
    }
    function transferMoney($desUsername,$value){
        global $mysqli;
        $stmt=$mysqli->prepare('insert into movements(value,withdrawAccId,depositeAccId) values (?,?,?)');
        if($stmt){
        $stmt->bind_param($value,$_SESSION['username'],$desUsername);
        $stmt->execute();
        return true;
        }
        else
            return false;
    }
?>
