<?php
include(__DIR__ . '/../includes/header.php');
?>
<div class="container">
    <div class="profile-box">
        <h1>الملف الشخصي</h1>
        <form action="">
            
            <!-- <div class="show-profile"> -->
                <label for="username">الاسم</label>
                <input type="text" name="username" id="username" value="<?php echo $_SESSION['username'] ?>" readonly>
                <label for="email">البريد الالكتروني</label>
                <input type="text" name="email" id="email" value="<?php echo $_SESSION['email'] ?>" readonly>
            <!-- </div> -->
        </form>
        <button class="update-profile">تعديل</button>
    </div>
</div>
</body>

</html>