<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بانک دیجیتال</title>
    <link rel="icon" href="src/Image/icon.png">
    <link rel="stylesheet" href="src/style/indexStyle.css">
</head>
<body>
<?php
    include './includes/db.php';
    include './includes/functions.php';
    $usernameErr=$lnameErr=$fnameErr = $emailErr = $passwordErr = "";
    $username = $fName = $lName = $email = $password = "";
    $hasError=false;
    if(isset($_POST['submit'])){
        $hasError=false;
        $username=$_POST['username'];
        $fName=$_POST['fName'];
        $lName=$_POST['lName'];
        $email=$_POST['email'];
        $password=$_POST['password'];
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "نام کاربری ضروری است";
        } else {
            $username = test_input($_POST["username"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
            $usernameErr = "فقط حروف الفبا انگلیسی و فاصله مجاز است";
            $hasError=true;
            }
            if(!uniqueUsername($username)){
                $usernameErr = "<br/>نام کاربری قبلا رزرو شده است";              
                $hasError=true;
            }
        }
        if (empty($_POST["fName"])) {
            $fnameErr = "نام ضروری است";
            $hasError=true;
        } else {
            $fName = test_input($_POST["fName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fName)) {
            $fnameErr = "فقط حروف الفبا انگلیسی و فاصله مجاز است";
            $hasError=true;
            }
        }
        if (empty($_POST["lName"])) {
            $lnameErr = "نام خانوادگی ضروری است";
            $hasError=true;
        } else {
            $lName = test_input($_POST["lName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$lName)) {
                $lnameErr = "فقط حروف الفبا انگلیسی و فاصله مجاز است";
                $hasError=true;
            }
        }
        
        if (empty($_POST["email"])) {
            $emailErr = "ایمیل ضروری است";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "ایمیل نامعتبر است";
                $hasError=true;
            }
            if(!uniqueEmail($email)){
                $emailErr="<br/>ایمیل تکراری است";
                $hasError=true;
            }
        }
            
        if (empty($_POST["password"])) {
            $passwordErr = "رمز عبور ضروری است";
        } else {
                $password = test_input($_POST["password"]);
                if(strlen($password)<=8){
                    $hasError=true;
                    $passwordErr="رمز عبور باید بیشتر از 8 حرف یا عدد باشد";
                }
            }
        }
        if(!$hasError){
            $cryptedPass=crypt($password,'$5$rounds=5000$somesillystringfordigitalbankapplication$');
            $queryStr="insert into users(username,first_name,last_name,email,password)";
            $queryStr.=" values ('$username','$fName','$lName','$email','$cryptedPass')";
            $result=$mysqli->query($queryStr);
            $mysqli->close();
        }
        
    }
?>
<?php
    $loginHasError=false;
    $loginEmail=$loginPassword="";
    $loginPasswordErr=$loginEmailErr="";
    if(isset($_POST['login__submit'])){
        $loginHasError=false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["login__email"])) {
                $loginEmailErr = "ایمیل ضروری است";
            } else {
                $loginEmail = test_input($_POST["login__email"]);
                // check if e-mail address is well-formed
                if (!filter_var($loginEmail, FILTER_VALIDATE_EMAIL)) {
                    $loginEmailErr = "ایمیل نامعتبر است";
                    $loginHasError=true;
                }
            }
            if (empty($_POST["login__password"])) {
                $loginPasswordErr = "رمز عبور ضروری است";
            } else {
                    $loginPassword = test_input($_POST["login__password"]);
                    if(strlen($loginPassword)<=8){
                        $loginHasError=true;
                        $loginPasswordErr="رمز عبور باید بیشتر از 8 حرف یا عدد باشد";
                    }
                }
            }
        // if($loginHasError){

        // }
        }
?>
    <header>
        <nav class="nav">
            <a class="nav-logo-link" href="index.php">
                <img src="src/Image/icon.png" alt="بانک دیجیتال" class="nav-logo">
                <h1 class="nav-logo-name">بانک دیجیتال</h1>
            </a>
            <ul class="nav-links">
                <li class="nav-link show-modal"><a href="#"> افتتاح حساب - ورود</a></li>
                <li class="nav-link"><a href="#features"> ویژگی ها</a></li>
                <li class="nav-link"><a href="#operations">عملیات</a></li>
                <li class="nav-link"><a href="#expriences">رضایت مشتری</a></li>
            </ul>
        </nav>
        <div class="intro-header">
            <div class="intro-img">
                <img src="./src/Image/intro_header_img.jpg" alt="بانک دیجیتال">
            </div>
            <div class="intro-description"> 
                
                <h1 class="intro-desc-header"> وقتی که <span class="highlight">بانک</span>  <br> در <span class="highlight">دست</span> شما است </h1>
                <h3 class="intro-desc-desc">یک تجربه آسان بانکی برای زندگی آسان تر</h3>
                <a href="" class="intro-more">بیشتر بدانید &downarrow;</a>
            </div>
        </div>
    </header>
    <section class="features" id="features">
        <div class="features-header">
            <h5>
                ویژگی ها
            </h5>
            <h1>
                تمام چیزی که از یک بانک انتظار دارید
            </h1>
            </div>
        </div>
        <div class="features-feature">
            <img src="src/Image/digital-lazy.jpg" class="lazy-img" alt="">
            <div class="features-details">
                <div class="feature-icon">
                    <div></div>
                </div>
                <h4 class="features-title">
                    100 درصد بانک دیجیتال
                </h4>
                <p class="section-row-desc">
                    از فرآیند افتتاح حساب تا تمامی تراکنش ها آنلاین می باشد
                </p>
            </div>
            <div class="features-details">
                <div class="feature-icon">
                    <div></div>
                </div>
                <h4 class="features-title">
                    رشد ارزش سرمایه  
                </h4>
                <p class="section-row-desc">
                   از طریق حساب های سرمایه گذاری می توانید ارزش سرمایه خود را افزایش دهید
                </p>
            </div>
            <img src="src/Image/grow-lazy.jpg" class="lazy-img" alt="">
            <img src="src/Image/card-lazy.jpg" class="lazy-img" alt="">
            <div class="features-details">
                <div class="feature-icon">
                    <div></div>
                </div>
                <h4 class="features-title">
                    کارت اعتباری رایگان
                </h4>
                <p class="section-row-desc">
                   بعد از افتتاح حساب یک کارت اعتباری رایگان برای شما ارسال می گردد که با آن می توانید کلیه پرداخت های حضوری خود را به صورت فیزیکی انجام دهید.
                </p>
            </div>
        </div>
    </section>
    
    <section class="operations" id="operations">
        <div class="operations-header">
            <h5>
                عملیات
            </h5>
            <h1>
                تمامی عملیات ها به ساده ترین شیوه ممکن طراحی شده اند
            </h1>
        </div>
        <div class="operations-operation">
            <div class="operations__tab--container">
               <button class="btn operations__tab operations__tab--3"  data-tab="3">
                    بستن آنی حساب 
               </button>
               <button class="btn operations__tab operations__tab--2"  data-tab="2">
                وام بدون انتظار
                </button>
               <button class="btn operations__tab operations__tab--1"  data-tab="1">
                انتقال فوری
           </button>
            </div>
            <div class="operatioins__content operatioins__content--1 operations__content--active" >
                <div class="operations__content--title">
                    <h3>
                        انتقال وجه به تمامی حساب ها درهر لحظه، بدون تاخیر
                    </h3>
                </div>
                <div class="operations__content--icon"></div>
                <div class="operations__content--desc">
                    <p> شما می توانید به صورت آنلاین در هر مکان، هر مقدار دلخواهی وجه را به تمامی حساب های سایر بانک ها
                        واریز نمایید، به گونه ای که هیچ گونه تاخیر در انتقال وجه وجود نخواهد داشت
                    </p>
                </div>
            </div>
            <div class="operatioins__content operatioins__content--2" >
            </div>
            <div class="operatioins__content operatioins__content--3" >
            </div>
        </div>
    </section>
    <section class="user-expriences" id="expriences">
        <div class="user__exprience--header">
            <h5>
                هنوز شک دارین ؟
            </h5>
            <h1>
                 هزاران کاربر با استفاده از بانک دیجیتال راحت ترین عملیات بانکی را تجربه می کنند
            </h1>
        </div>
        
        <div class="slider">
            <div class="slide slide--1">
                <div class="exprience">
                    <h3 class="slider__header">بهترین تصمیم مالی من</h3>
                    <blockquote class="slider__quote">
                        انتخاب بانک دیجیتال برای انجام امور بانکی من، جز بهترین تصمیم های مالی من بوده است. یکی از دلایل انتخاب بانک دیجیتال
                        دسترسی تمام وقت به ریز تراکنش ها بدون کسر کارمزد است.
                                دلیل دیگر انجام معاملات بانکی بدون تاخیر و به صورت آنی بوده که به دلیل نداشتن محدودیت سقف انتقال جزو محدود بانک هایی می باشد که این امکان را در اختیار کاربر می گذارد.
                        
                    </blockquote>
                    <address class="slider__address">
                        <h6>آروین</h6>
                        <img src="src/Image/user-1.jpg" alt="پروفایل کاربر">
                        <p>ایران، تهران</p>
                    </address>
                </div>
            </div>
            <button class="slider__btn slider__btn--right">&rightarrow;</button>
            <button class="slider__btn slider__btn--left">&LeftArrow;</button>
        </div>
    </section>
    <section class="section section__sign-up">
        <div class="section__sign-up--title">
            <h1>بهترین زمان برای افتتاح حساب یکسال پیش بود. بهترین زمان بعدی همین امروز است</h1>
        </div>
        <button class="btn btn__show-modal show-modal">همین امروز حساب باز کنید</button>
    </section>
    <footer class="footer">
        <ul class="footer__nav">
            <li>تماس با ما</li>
            <li>بلاگ</li>
            <li>فرصت های شغلی</li>
            <li>حریم کاربران</li>
            <li>شرایط استفاده</li>
            <li>تعرفه ها</li>
            <li>درباره ما</li>
        </ul>
        <img src="src/Image/icon.png" alt="digital bank" class="footer__img">
        <p class="footer__copyright">&copy; 2022 Copyright by Digital Bank</p>
    </footer>
    <div class="modal__sign-up hidden">
        <button class="btn modal__sign-up--btn-close">&Cross;</button>
        <h2 class="modal__sign-up--header">فقط در<span class="highlight">5 دقیقه</span> حساب خود را باز نمایید.</h2>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="post" class="sign-up--form">
            <label for="username" class="sign-up__label">نام کاربری</label>
            <div class="input--holder">
                <input type="text" name="username" id="username" class="sign-up__input input sign-up__input--password" required value="<?php if($username!='') echo $username;?>" >
                <p class="error sign-up__error"><?php if($usernameErr) echo $usernameErr;?></p>
            </div>    
            <label for="fName" class="sign-up__label">نام</label>
            <div class="input--holder">
                <input type="text" name="fName" id="fName" class="sign-up__input input sign-up__input--f-name" required value="<?php if($fName!='') echo $fName;?>">
                <p class="error sign-up__error"><?php  if($fnameErr) echo $fnameErr;?></p>
            </div>
            <label for="lName" class="sign-up__label">نام خانوادگی</label> 
            <div class="input--holder">
                <input type="text" name="lName" id="lName" class="sign-up__input input sign-up__input--l-name" required value="<?php if($lName!='') echo $lName;?>">
                <p class="error sign-up__error"><?php if($lnameErr) echo $lnameErr;?></p>
            </div>
            <label for="email" class="sign-up__label">ایمیل</label>
            <div class="input--holder">
                <input type="email" name="email" id="email" class="sign-up__input input sign-up__input--email" required  value="<?php if($email!='') echo $email;?>">
                <p class="error sign-up__error"><?php if($emailErr) echo $emailErr;?></p>
            </div>
            <label for="password" class="sign-up__label"> رمز عبور</label>
            <div class="input--holder">
                <input type="password" name="password" id="password" class="sign-up__input input sign-up__input--password" required >
                <p class="error sign-up__error"><?php if($passwordErr) echo $passwordErr;?></p>
            </div>
            <button type="submit" name="submit" class="btn sign-up__submit--btn" >مرحله بعد &leftarrow;</button>
        </form>
        <div class="login__link--holder">
            <a href="" class="show__login--modal">وارد حسابتان شوید</a>
        </div>
    </div>
    <div class="modal__login hidden">
        <button class="btn modal__login--btn-close">&Cross;</button>
        <h2 class="modal__login--header">اطلاعات حساب خود را جهت ورود وارد نمایید</h2>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="post" class="login--form">
            <label for="login__email" class="login__label">ایمیل</label>
            <div class="input--holder">
                <input type="email" name="login__email" id="login__email" class="login__input input login__input--email" required  value="<?php if($loginEmail!='') echo $loginEmail;?>">
                <p class="error login__error"><?php if($loginEmailErr) echo $loginEmailErr;?></p>
            </div>
            <label for="login__password" class="login__label"> رمز عبور</label>
            <div class="input--holder">
                <input type="password" name="login__password" id="login__password" class="login__input input login__input--password" required >
                <p class="error login__error"><?php if($loginPasswordErr) echo $loginPasswordErr;?></p>
            </div>
            <button type="submit" name="login__submit" class="btn login__submit--btn" >وارد شوید &leftarrow;</button>
        </form>
        <div class="login__link--holder">
            <a href="" class="show-modal">ایجاد حساب</a>
        </div>
    </div>
    <div class="overlay hidden"></div>
    <script src="src/js/index-script.js"></script>
    <?php
        $str="<script>";
        if($hasError)  
            $str.= "document.querySelector('.show-modal').click();";
        if($loginHasError)  
            $str.="document.querySelector('.show__login--modal').click();";
        $str.="</script>";
        echo $str;
    ?>
</body>
</html>