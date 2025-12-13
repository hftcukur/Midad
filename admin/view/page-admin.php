<?php require(__DIR__ . '/../includes/header.php');; ?>
<main>
    <section>
        <div class="container">
            <div class="main-content">
                <div class="box-admin add-new-book">
                    <a href="addBook">
                        <span> إضافة كتاب</span><i class="fa-solid fa-book-medical"></i>

                    </a>
                </div>
                <div class="search-book">
                    <form action="">
                        <input type="text" name="search-for" id="search-for" placeholder="ابحث عن كتاب" required>
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
                        <th>رقم الكتاب </th>
                        <th>اسم الكتاب</th>
                        <th>المؤلف </tdh>
                        <th>تاريخ النشر</th>
                        <th>دار النشر</th>
                        <th> الحدث</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>حسين</td>
                        <td>علي</td>
                        <td>2020</td>
                        <td>نور</td>
                        <td class="action-btn">
                            <button class="btn delete" onclick="window.location='page2.php?id=5'"><i class="fa-solid fa-trash"></i></button>
                            <button class="btn update" onclick="window.location='updateBook.php?updateID=5'"><i class="fa-solid fa-pen"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>

</html>