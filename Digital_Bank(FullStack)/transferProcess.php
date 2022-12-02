<?php
    class transferDetails{
        public $hasError;
        public $errMsg=[];
        function __construct($hasError,$errorMsg){
            $this->hasError=$hasError;
            $this->errMsg=$errorMsg;
        }
    }
    include './includes/functions.php';
    $hasError=false;
    $errorMsg=[];
    if(isset($_POST['transferUsername']) && isset($_POST['transferValue'])){
        $transferUsername=$_POST['transferUsername'];
        $transferValue=$_POST['transferValue'];
        if(getUserInformation($transferUsername)){
            $hasError=true;
            array_push($errorMsg,'نام کاربری حساب مقصد موجود نمی‌باشد');
        }   
        if((float)getCash()<(float)$transferValue){
            $hasError=true;
            array_push($errorMsg,'موجودی حساب کافی نمی‌باشد');
        }
        if(!$hasError){
            $transferResult=transferMoney($transferUsername,$transferValue);
            if(!$transferResult){
                $hasError=true;
                array_push($errorMsg,'فرآیند انتقال با خطا مواجه شد');
            }
        }
    }
    else{
        $hasError=true;
        array_push($errorMsg,'ورودی نام کاربری یا مقدار انتقالی خالی است');
    }
    $transferResult=new transferDetails($hasError,$errorMsg);
    echo json_decode($transferResult);
?>