<?php 
    include './includes/db.php';
    include './includes/functions.php';
    session_start();
    class movsObj{
        public $id;
        public $interestRate;
        public $movements=[];
        public $movementsDates=[];
        function __construct($id,$interestRate){
            $this->id=$id;
            $this->interestRate=$interestRate;
        }
    }
    // $test=uniqueEmail("dsdfd");
    $bankAccountData=bankAccInf();
    // $bankAccountData['id']=1;
    // $bankAccountData['interestRate']=2;
    $strQuery="select value*(-1),date from movements where withdrawAccId=? ";
    $strQuery.="union select value,date from movements where depositeAccId=?  order by date";
    $movmentsStmt=$mysqli->prepare($strQuery);
    $movmentsStmt->bind_param("ss",$bankAccountData['id'],$bankAccountData['id']);
    $movmentsStmt->execute();
    $movmentsStmt->bind_result($value,$movDate);
    $sendObj=new movsObj($bankAccountData['id'],$bankAccountData['interestRate']);
    while($movmentsStmt->fetch()){
        array_push($sendObj->movements,$value);
        array_Push($sendObj->movementsDates,$movDate);
    }
    $myJSON=json_encode($sendObj);
    echo $myJSON;
?>