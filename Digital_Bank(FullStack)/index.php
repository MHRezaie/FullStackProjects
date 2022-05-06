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
    $usernameErr=$lnameErr=$fnameErr = $emailErr = $genderErr = $websiteErr = "";
    $name = $email = $gender = $comment = $website = "";
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $fName=$_POST['fName'];
        $lName=$_POST['lName'];
        $email=$_POST['email'];
        $password=$_POST['password'];
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "Name is required";
        } else {
            $username = test_input($_POST["username"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
            $usernameErr = "نام کاربری فقط حروف الفبا انگلیسی و فاصله مجاز است";
            }
        }
        if (empty($_POST["fName"])) {
            $fnameErr = "Name is required";
        } else {
            $fName = test_input($_POST["fName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fName)) {
            $fnameErr = "Only letters and white space allowed";
            }
        }
        if (empty($_POST["lName"])) {
            $lnameErr = "Name is required";
        } else {
            $lName = test_input($_POST["lName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$lName)) {
            $lnameErr = "Only letters and white space allowed";
            }
        }
        
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            }
        }
            
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
            }
        }
        $cryptedPass=crypt($password,'$5$rounds=5000$digitalbankrandomstring$KqJWpanXZHKq2BOB43TSaYhEWsQ1Lr5QNyPCDH/Tp.6');
        $queryStr="insert into users(username,first_name,last_name,email,password)";
        $queryStr.=" values ('$username','$fName','$lName','$email','$cryptedPass')";
        // global $connection;
        // $insertResult=mysqli_query($connection,$queryStr);
        // if(!$insertResult){
        //     die('insert failled'.mysqli_error($connection));
        // }
        if (!mysqli_query($connection, $queryStr)) {
            printf("Error message: %s\n", mysqli_error($connection));
        }
    }
    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
?>
    <header>
        <nav class="nav">
            <a class="nav-logo-link" href="index.html">
                <img src="src/Image/icon.png" alt="بانک دیجیتال" class="nav-logo">
                <h1 class="nav-logo-name">بانک دیجیتال</h1>
            </a>
            <ul class="nav-links">
                <li class="nav-link show-modal"><a href="#">افتتاح حساب</a></li>
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
            <label for="password" class="sign-up__label">نام کاربری</label>
            <input type="text" name="username" id="username" class="sign-up__input input sign-up__input--password" required >
            <label for="fName" class="sign-up__label">نام</label>
            <input type="text" name="fName" id="fName" class="sign-up__input input sign-up__input--f-name" required >
            <label for="lName" class="sign-up__label">نام خانوادگی</label> 
            <input type="text" name="lName" id="lName" class="sign-up__input input sign-up__input--l-name" required >
            <label for="email" class="sign-up__label">ایمیل</label>
            <input type="email" name="email" id="email" class="sign-up__input input sign-up__input--email" required >
            <label for="password" class="sign-up__label"> رمز عبور</label>
            <input type="password" name="password" id="password" class="sign-up__input input sign-up__input--password" required >
            <button type="submit" name="submit" class="btn sign-up__submit--btn" >مرحله بعد &leftarrow;</button>
        </form>
    </div>
    <div class="overlay hidden "></div>
    <script src="src/js/index-script.js"></script>
</body>
</html>