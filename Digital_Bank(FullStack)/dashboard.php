<?php
        session_start();
        include './includes/db.php';
        include './includes/functions.php';
        $loginUsername="";
        $isLogedin=false;
        if(isset($_SESSION["isLogedin"]) && isset($_SESSION["username"])){
            $loginUsername=$_SESSION['username'];
            $isLogedin=true;
        }
        else{
            header("location: ../index.php");
        }
    ?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="src/style/style.css">
    <link rel="stylesheet" href="src/style/commonStyle.css">
    <link rel="icon" href="src/Image/icon.png">
    <title>بانک دیجیتال</title>
</head>
<body>
    <?php include "./includes/preloader.php"; ?>
    <nav>
        <div class="profile">
            <img src="/src/image/user.png" alt="پروفایل کاربری" class="profile__img">
        </div>
        <div class="home__link">
            <img src="src/Image/icon.png" alt="money" class="logo"> <a href=".." class="main__page">صفحـــه اصلی</a>
        </div>
    </nav>
    <main class="app">
        <div class="balance">
          <div class="balance-desc">
              <p class="balance-lable"> موجودی کل </p>
              <p class="balance-date">تاریخ<span class="date">2/10/2022</span></p>
              <button class="refresh__btn">بروز‌‌‌‌‌‌‌‌‌‌ رسانی</button>
          </div>
          <p class="balance-value"> 0000 <sup class="balance-unit">تومان</sup> </p>
        </div>
        <div class="movments">
          <div class="movements__holder">
            <div class="movements__loader">
            </div>
            <p class="empty__movs--error"> </p>
          </div>
        </div>
        <div class="summary">
            <p class="summary_label">واریزی</p>
            <p class="summary_value  summary_value_in">0000</p>
            <p class="summary_label">برداشت</p>
            <p class="summary_value summary_value_out">0000</p>
            <p class="summary_label">سود</p>
            <p class="summary_value summary_value_interest">0000</p>
        </div>
        <div class="logout-timer">
            <p>تا <span class="timer">5:00</span> دیگر از سیستیم خارج خواهید شد </p>
            <button class="sort">&HorizontalLine;</button>
        </div>
        <div class="process transfer">
            <h2>انتقال</h2>
            <form class="action-form form-transfer">
                <input type="text" name="transfer-to" id="transfer-to" class="input-form transfer-to-input" placeholder="نام کاربری">
                <input type="number" name="transfer-value" id="transfer-value" class="input-form transfer-to-value">
                <button class="btn-form btn-transfer">&rightarrow;</button>
                <label for="transfer-to" class="form-label">واریز به</label>
                <label for="transfer-value" class="form-label">مقدار</label>
            </form>
        </div>
        <div class="process loan">
            <h2>درخواست وام</h2>
            <form class="action-form form-loan">
                <input type="number" name="loan-value" id="loan-value" class="input-form transfer-to-value">
                <button class="btn-form btn-loan">&rightarrow;</button>
                <label for="transfer-value" class="form-label loan-label">مقدار</label>
            </form>
        </div>  
        <div class="process close">
            <h2>بستن حساب</h2>
            <form class="action-form action-form">
                <form class="action-form form-transfer">
                    <input type="text" name="transfer-to" id="transfer-to" class="input-form transfer-to-input">
                    <input type="number" name="transfer-value" id="transfer-value" class="input-form transfer-to-value">
                    <button class="btn-form btn-transfer">&rightarrow;</button>
                    <label for="transfer-to" class="form-label">نام کاربری</label>
                    <label for="transfer-value" class="form-label">رمز عبور</label>
                </form>
            </form>
        </div>
    </main>
    <script src="src/js/commonScript.js"></script>
    <script src="src/js/script.js">
    </script>
    <div class="msg__modal">
        <button class="btn modal__login--btn-close">&Cross;</button>
        <div class="msg__content">
            <p class='msg error'>خطایی رخ داده است</p>
            <p class='msg notif'>انتقال با موفقیت رخ داد</p>
        </div>
    </div>
</body>
</html>
