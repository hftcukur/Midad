<?php
$pageTitle = $infoBook['title'] . ' | مِداد';

include(__DIR__ . '/../includes/header.php'); ?>
<main>
  <section class="container">
    <h1 class="title_book_info"> تحميل كتاب <?php echo $infoBook['title'] ?> PDF </h1>
    <div class="book-main">
      <div class="book_info">
        <div class="img_book">
          <img src="<?= $infoBook['image'] ?>" alt="<?= $book['title'] ?>" loading="lazy">

        </div>
        <div class="ditles">
          <h2><?php echo $infoBook['title'] ?> </h2>
          <table>
            <tbody>
              <tr>
                <td>مؤلف</td>
                <td><?php echo $infoBook['authorName'] ?></td>
              </tr>
              <tr>
                <td>القسم</td>
                <td><?php echo $infoBook['title_category'] ?></td>
              </tr>
              <tr>
                <td>اللغة</td>
                <td><?php echo $infoBook['language'] ?></td>
              </tr>
              <tr>
                <td>الناشر</td>
                <td>دار ابن الجوزي</td>
              </tr>
              <tr>
                <td>الصفحات</td>
                <td><?php echo $infoBook['pages'] ?></td>
              </tr>
              <tr>
                <td>حجم الملف </td>
                <td><?php echo $infoBook['file_size'] ?>. ميجا بايت</td>
              </tr>
              <tr>
                <td>نوع الملف</td>
                <td><?php echo $infoBook['file_type'] ?></td>
              </tr>
              <tr>
                <td> تاريخ الانشاء</td>
                <td><?php echo $infoBook['year'] ?></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
      <div class="last-book">
        <h3>كتب أخرى</h3>
        <ul>
          <li> <a href="">ليلي البيضاء</a> <i class="fas fa-book"></i></li>
          <li> <a href="">ليلي البيضاء</a> <i class="fas fa-book"></i></li>
          <li> <a href="">ليلي البيضاء</a> <i class="fas fa-book"></i></li>
          <li> <a href="">ليلي البيضاء</a> <i class="fas fa-book"></i></li>
          <li> <a href="">ليلي البيضاء</a> <i class="fas fa-book"></i></li>
          <li> <a href="">ليلي البيضاء</a> <i class="fas fa-book"></i></li>
          <li> <a href="">ليلي البيضاء</a> <i class="fas fa-book"></i></li>
          <li> <a href="">ليلي البيضاء</a> <i class="fas fa-book"></i></li>
          <li> <a href="">ليلي البيضاء</a> <i class="fas fa-book"></i></li>
          <li> <a href="">ليلي البيضاء</a> <i class="fas fa-book"></i></li>
        </ul>
      </div>
    </div>
    <section class="info_book">
      <div class="action_book">
        <a href="<?php echo $infoBook['book_url']; ?>" download data-id="<?php echo $infoBook['id_book']?> " onclick="incrementDownload(this)"><i class="fas fa-download"></i> <?php echo $infoBook['downloads']?></a>
        <a href="<?php echo $infoBook['book_url']; ?>" target="_blank"  data-id="<?php echo $infoBook['id_book']?>" onclick="incrementReadBook(this)"> <i class="fa-solid fa-book-open"></i> <?php echo $infoBook['readBook']?></a>
        <button class="sharing"><i class="fas fa-share-alt"></i>مشاركة</button>
        <!-- <button class="btn-like-book"><i class="fas fa-thumbs-up"></i></button> -->
      </div>
    </section>
    <div class="book_descrption">
      <h3>وصف الكتب</h3>
      <p><?php echo $infoBook['description'] ?></p>
    </div>
  </section>
</main>
<?php include(__DIR__ . '/../includes/footer.php'); ?>