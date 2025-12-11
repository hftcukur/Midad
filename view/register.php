<?php $pageTitle =  " انشاء حساب   | مِداد"; 
 include(__DIR__ . '/../includes/header.php');

$errorMsg = isset($_GET['errorMsg']) ? $_GET['errorMsg'] : "";
?>
<main>
    <section>
        <div class="container">
            <div class="register">
                <h1>انشاء حساب</h1>
                <p><?php echo $errorMsg ?></p>
                <form action="/Madad/register" method="POST">
                    <label for="username">اسم المستخدم</label>
                    <input type="text" name="username" id="username" value="username">
                    <label for="email">البريد الالكتروني</label>
                    <input type="email" name="email" id="email" placeholder="you@email.com" required>
                    <label for="password">كلمة المرور</label>
                    <input type="password" name="password" id="password" placeholder="كلمة المرور" maxlength="10" minlength="8" required>
                    <button type="submit" name="submit_register" class="btn-register"> انشاء حساب</button>
                </form>
            </div>
        </div>
    </section>
</main>
