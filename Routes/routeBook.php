<?php
require_once  '../model/ModelBook.php';
require_once  '../Controller/controllBook.php';
require_once  '../database/database.php';
$database   = "";
$ModelBook = new ModelBook($database);
$controllBook = new ControllBook($ModelBook);
$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {

    case 'search':
        if (isset($_GET['bookName'])) {
            $bookName = $_GET['bookName'];
            $resultSearch = $controllBook->search($bookName);
            include('../view/books.php');

            exit();
        }
        break;

    case 'insert':
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBook'])) {

            $bookName = $_POST['bookName'];
            $authorName = $_POST['authorName'];
            $publish_year = $_POST['publish_year'];
            $category = $_POST['category'];
            $pages = $_POST['pages'];
            $description = $_POST['description'];

            $image = $_FILES['image_url'];
            $fileName = $image['name'];
            $tmpName = $image['tmp_name'];

            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array($extension, $allowed)) {

                $newName = uniqid() . "." . $extension;
                $path = "../uploads/" . $newName;

                move_uploaded_file($tmpName, $path);

                if ($controllBook->insertBook($bookName, $authorName, $publish_year, $category, $pages, $description, $path)) {
                    header("location:../admin/view/addBook.php?success=" . urlencode("تم إضافة الكتاب بنجاح"));
                    exit();
                }

                header("location:../admin/view/addBook.php?notSuccess=" . urlencode("فشل إضافة الكتاب"));
                exit();
            }
        }
        break;

            default:
            $allBooks = $controllBook->showAllBooks();
            include('../view/books.php');
            exit();
}
