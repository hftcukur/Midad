<?php
$pageTitle = $infoAuthor['name'] . " | مِداد";
include(__DIR__ . '/../includes/header.php'); ?>

<main>
    <div class="container">
        <div class="authro-card">
            <div class="header-authro">
                <div class="img_author">
                    <img src="uploads/Author_profile/<?php echo $infoAuthor['image'] ?>" alt="" loading="lazy">
                </div>
                <div class="authro-name">
                    <h1 title="name"> <?php echo $infoAuthor['name'] ?> </h1>
                    <p>التقيم (1.2) </p>
                </div>
            </div>
            <article class="author-bio">
                <p><?php echo $infoAuthor['bio'] ?></p>
            </article>
        </div>
    </div>
    <section>
        <div class="container">

            <div class="authro-stats">
                <ul>
                    <li>
                        <span>الكتب</span>
                        <span>(21)</span>
                    </li>

                    <li>
                        <span>اجمالي التحميل</span>
                        <span>(<?php echo $id ?>)</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <h2>كتب له</h2>
            <div class="books_madad">
                <!-- Start -->
                <?php foreach ($allBooksAuthor as $book): ?>
                    <div class="box_madad" title="<?= $book['title'] ?>">
                        <a href="book_ditles?bookID=<?= $book['id_book'] ?>" class="link-book">
                            <img src="<?= $book['image'] ?>" alt="<?= $book['title'] ?>" loading="lazy">
                        </a>
                        <a href="book_ditles?bookID=<?= $book['id_book'] ?>" class="book_title" title="<?= $book['title'] ?>"> <?= $book['title'] ?></a>
                        <a href="info_author?authroID=<?= $book['id_author'] ?>" class="author" title="<?= $book['name'] ?>"> <?= $book['name'] ?></a>
                    </div>
                <?php endforeach; ?>
                <!-- End -->
            </div>
        </div>
    </section>
</main>
<?php include(__DIR__ . '/../includes/footer.php'); ?>