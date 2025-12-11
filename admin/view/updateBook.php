<?php
session_start();
include('../includes/header.php');

// Start Section Book

$success = isset($_GET['success']) ? $_GET['success'] : "";
$notSuccess = isset($_GET['notSuccess']) ? $_GET['notSuccess'] : "";
if (isset($_GET['updateID'])) {
    $_SESSION['updateID'] = $_GET['updateID'];
}

?>
<main>
    <section>
        <div class="container">

            <div class="box-add-book">
                <h1>تعديل كتاب <?php echo $updateBook['bookName']; ?></h1>
                <?php if (!empty($success)): ?>
                    <p> <?php echo $success ?></p>
                <?php elseif (!empty($notSuccess)): ?>
                    <p> <?php echo $notSuccess ?></p>
                <?php endif; ?>

                <form action="../../Routes/route.php" method="POST" enctype="multipart/form-data">
                    <div class="box-form">
                        <label for="book_name">اسم الكتاب</label>
                        <input type="text" name="bookName" id="book_name" placeholder="ادخل اسم الكتاب" required value="<?php echo $updateBook['bookName'] ?>">
                    </div>
                    <div class="box-form">

                        <label for="authro">اسم المؤلف</label>
                        <input type="text" name="authorName" id="authro" placeholder="ادخل اسم المؤلف" required value="<?php echo $updateBook['authorName'] ?>">
                    </div>
                    <div class="box-form">

                        <label for="date">سنة النشر</label>
                        <input type="date" name="publish_year" id="date" placeholder="ادخل سنة النشر" required value="<?php echo $updateBook['publish_year'] ?>">
                    </div>
                    <div class="box-form">

                        <label for="category">التصنيف</label>
                        <input type="text" name="category" id="category" placeholder="ادخل التصنيف" required value="<?php echo $updateBook['category'] ?>">
                    </div>
                    <div class="box-form">

                        <label for="pages">عدد الصفحات</label>
                        <input type="number" name="pages" id="pages" placeholder="ادخل عدد الصفحات" required value="<?php echo $updateBook['pages'] ?>">
                    </div>
                    <div class="box-form">
                        <label>الوصف</label>
                        <textarea name="description" id="">
                            <?php echo $updateBook['description'] ?>
                        </textarea>
                    </div>
                    <div class="box-form">
                        <label for="fileInput" class="upload-btn">اختر صورة</label>
                        <input type="file" id="fileInput" name="image_url" accept="image/*">
                    </div>


                    <input type="submit" name="addBook" value="تعديل">
                </form>
            </div>

        </div>
    </section>
</main>