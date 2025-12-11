<?php $pageTitle =  "   تسجيل دخول  | مِداد";
include(__DIR__ . '/../includes/header.php');

$Message  = isset($_GET['Message']) ? $_GET['Message'] : "";
?>
<main>
    <section>
        <div class="container">
            <div class="register">
                <p><?= $Message ?></p>
                <h1> تسجيل دخول </h1>
                <form action="" method="post">
                    <label for="email">البريد الالكتروني</label>
                    <input type="email" name="email" id="email" placeholder="you@email.com" required>
                    <label for="password">كلمة المرور</label>
                    <input type="password" name="password" id="password" placeholder="كلمة المرور" required>
                    <label for="login-as">تسجيل دخول ك</label>
                    <select name="login-as" id="login-as" required>
                        <option value="user">مستخدم</option>
                        <option value="admin">مشرف الموقع</option>
                    </select>
                    <button type="submit" name="login" class="btn-register"> تسجيل دخول</button>
                </form>
            </div>
        </div>
    </section>
</main>