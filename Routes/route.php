<?php

// session_start();
// include_once  '../model/ModelBook.php';
// include_once  '../model/ModelUser.php';
// include_once  '../model/ModelAdmin.php';
// include_once  '../Controller/controllBook.php';
// include_once  '../Controller/controllAdmin.php';
// include_once  '../Controller/ControllUser.php';
// include_once  '../functions/functions.php';
// require_once  '../database/database.php';

// // $database  = databaseConnection();
// $database   = "";
// $ModelUser = new ModelUser($database);
// $controllUser = new ControllUser($ModelUser);
// $ModelAdmin = new ModelAdmin($database);
// $controllAdmin = new controllAdmin($ModelAdmin);
// $ModelBook = new ModelBook($database);
// $controllBook = new ControllBook($ModelBook); 
// // Start Section Book
// $action = $_GET['action'] ?? $_POST['action'] ?? '';

// switch ($action) {

//     // البحث
//     case 'search':
//         if (isset($_GET['bookName'])) {
//             $bookName = $_GET['bookName'];
//             $controllBook->searchBook($bookName);
//             exit();
//         }
//         break;

//     // الإضافة
//     case 'insert':
//         if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBook'])) {

//             $bookName = $_POST['bookName'];
//             $authorName = $_POST['authorName'];
//             $publish_year = $_POST['publish_year'];
//             $category = $_POST['category'];
//             $pages = $_POST['pages'];
//             $description = $_POST['description'];

//             $image = $_FILES['image_url'];
//             $fileName = $image['name'];
//             $tmpName = $image['tmp_name'];

//             $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
//             $allowed = ['jpg', 'jpeg', 'png', 'webp'];

//             if (in_array($extension, $allowed)) {

//                 $newName = uniqid() . "." . $extension;
//                 $path = "../uploads/" . $newName;

//                 move_uploaded_file($tmpName, $path);

//                 if ($controllBook->insertBook($bookName, $authorName, $publish_year, $category, $pages, $description, $path)) {
//                     header("location:../admin/view/addBook.php?success=" . urlencode("تم إضافة الكتاب بنجاح"));
//                     exit();
//                 }

//                 header("location:../admin/view/addBook.php?notSuccess=" . urlencode("فشل إضافة الكتاب"));
//                 exit();
//             }
//         }
//         break;

//     // العرض الافتراضي
//     default:
//         $controllBook->showAllBooks();
//         exit();
// }

// End Section Book

// Start Section login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['login'])) {
        if ($_POST['login-as'] == 'user') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $hashPassword = Encryption($password);
            if ($controllUser->isLoggedIn($email, $hashPassword)) {
                header("location: ../view/home.php");
                exit();
            } else {
                header("location: ../view/login.php?Message=" . urlencode("يرجاء انشاء حساب اولاُ"));
                exit();
            }
        } elseif ($_POST['login-as'] == 'admin') {
            $adminEmail = $_POST['email'];
            $adminPassword = $_POST['password'];
            $hashPasswordAdmin = Encryption($adminPassword);
            if ($controllAdmin->isLoggedIn($adminEmail, $hashPasswordAdmin)) {

                header("location: ../admin/view/page-admin.php");
                exit();
            } else {
                header("location: ../view/login.php?Message=" . urlencode("البريد ا كلمة المرور خاطئة"));
            }
        }
    }
}
// End Section login
// Start Section Register User
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit_register'])) {
        if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $hashPassword = Encryption($password);
            if ($controllUser->insert($username, $email, $hashPassword)) {
                header("location: ../public/index.php");
                exit();
            } else {
                header("location: ../view/register.php?errorMsg=" . urlencode("فشل انشاء حساب"));
                exit();
            }
        } else {
            echo "Nothing";
        }
    }
}
// End Section Register User



// if (isset($_SESSION['updateID'])) {

//     $updateBook = $controllBook->findByID($_SESSION['updateID']);

//     include('../admin/view/updateBook.php');
//     exit();
// }

// end Section Add Book
