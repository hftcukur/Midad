<?php require(__DIR__ . '/../includes/header.php');; ?>
<main>
    <section>
        <div class="container">
            <div class="main-content">
                <div class="box-admin add-new-book">
                    <a href="addAdmin">
                        <span> إضافة مؤلف</span><i class="fa-solid fa-book-medical"></i>

                    </a>
                </div>
                <div class="search-book">
                    <form action="">
                        <input type="text" name="search-for" id="search-for" placeholder="ابحث عن مؤلف" required>
                        <button type="submit" name="submit" class="submit-search"> بحث </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="table-books">
            <table>
                <thead>
                    <tr>
                        <th>رقم المؤلف </th>
                        <th>اسم المؤلف</th>
                        <th> الحدث</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allAdmins as $Admin):?>
                    <tr>
                        <td><?php echo $Admin['admin_id'] ?></td>
                        <td><?php echo $Admin['name'] ?></td>
                        <td class="action-btn">
                            <button class="btn delete" onclick="window.location='page2.php?id=5'">حذف</button>
                            <button class="btn update" onclick="window.location='updateBook.php?updateID=5'">تعديل</button>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>

</html>