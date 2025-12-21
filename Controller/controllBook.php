<?php
include __DIR__ . '/../helpers/handlingFiles.php';

class ControllBook
{
    private $modelBook;
    public function __construct($model)
    {
        $this->modelBook = $model;
    }
    public function getAll()
    {
        $allBooks = $this->modelBook->loadAllBooks();
        return $allBooks;
    }
    function  getInfoBookAndAuthor()
    {
        return $this->modelBook->join_books_authors();
    }
    function getAllCategory()
    {
        return $this->modelBook->loadCategory();
    }
    public function findByID()
    {
        if (isset($_GET['ID'])) {
            $id = $_GET['ID'];
            return $this->modelBook->findOneByid($id);
        }
    }
    public function deleteBook()
    {
        if (isset($_POST['idDeleletBook'])) {
            return $this->modelBook->delete($_POST['idDeleletBook']);
        }
    }

    //Upload Files Book And Image 

    //  Check If Come From Server And  No Error
    function receptionDataBook($action)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["$action"])) {
            if (empty($_POST['bookName'])) {
                return ['hasInputEmpty' => 'يرجاء كتابة اسم الكتاب'];
            }
            if (empty($_POST['id_author'])) {
                return ['hasInputEmpty' => 'يرجاء تحدد المؤلف'];
            }
            if (empty($_POST['publish_year'])) {
                return ['hasInputEmpty' => 'يرجاء تحديد السنة'];
            }
            if (empty($_POST['id_category'])) {
                return ['hasInputEmpty' => 'يرجاء تحديد الفئة'];
            }
            if (empty($_POST['pages'])) {
                return ['hasInputEmpty' => 'يرجاءإدخال عدد الصفحات'];
            }
            if (empty($_POST['file_type'])) {
                return ['hasInputEmpty' => 'يرجاء تحدد نوع الملف'];
            }
            if (empty($_POST['description'])) {
                return ['hasInputEmpty' => 'يرجاءإدخال وصف الكتاب'];
            }
            if (
                !isset($_FILES['image_url']) ||
                $_FILES['image_url']['error'] !== UPLOAD_ERR_OK ||
                $_FILES['image_url']['size'] == 0
            ) {
                return ['hasInputEmpty' => 'يرجاء إدخال الصورة'];
            }

            if (empty($_POST['language'])) {
                return ['hasInputEmpty' => 'يرجاء تحدد اللغة'];
            }
            if (
                !isset($_FILES['book_url']) ||
                $_FILES['book_url']['error'] !== UPLOAD_ERR_OK ||
                $_FILES['book_url']['size'] == 0
            ) {
                return ['hasInputEmpty' => 'يرجاء إدخال الكتاب'];
            }
        }
        return false;
    }
    public function updateBook()
    {
        $hasError =  $this->receptionDataBook('updateBook');

        if ($hasError) {
            return $hasError;
        }
        $id = $_GET['ID'] ?? 0;
        $bookName = $_POST['bookName'] ?? null;
        $year = $_POST['publish_year'] ?? null;
        $id_category = $_POST['id_category'] ?? null;
        $id_author = $_POST['id_author'] ?? null;
        $pages = $_POST['pages'] ?? null;
        $description = $_POST['description'] ?? null;
        $file_type = $_POST['file_type'] ?? null;
        $image = $_FILES['image_url'] ?? null;
        $book = $_FILES['book_url'] ?? null;
        $language = $_POST['language'] ?? null;
        // Use  Data Book After Prossing 
        $feedBackUploadImage = HandlingFiles::uploadImage($image, __DIR__ . '/../uploads/image_book/', 'uploads/image_book/');
        $feedBackUploadBook = HandlingFiles::uploadBook($book, __DIR__ . '/../uploads/book_url/', 'uploads/book_url/');
        if (isset($feedBackUploadBook['hasInputEmpty'])) {
            return  $feedBackUploadBook;
        }
        if (isset($feedBackUploadImage['hasInputEmpty'])) {
            return $feedBackUploadImage;
        }
        $file_size = $feedBackUploadBook['file_size'];
        $pathBook = $feedBackUploadBook['PathBook'];
        $pathImage = $feedBackUploadImage['pathImage'];
        $resultUpdate =  $this->modelBook->updateBook($id, $bookName, $id_author, $year, $id_category, $pages, $description, $pathImage, $file_size, $file_type, $language, $pathBook);
        return ($resultUpdate) ? ['successUpdate' => 'تم تعديل الكتاب'] : ['failedUpdate' => 'فشل تعديل الكتاب'];
    }
    public function addBook()
    {
        $hasError = $this->receptionDataBook('addBook');
        if (!empty($hasError)) {
            return $hasError;
        } else {

            $bookName = $_POST['bookName'] ?? null;
            $year = $_POST['publish_year'] ?? null;
            $id_category = $_POST['id_category'] ?? null;
            $id_author = $_POST['id_author'] ?? null;
            $pages = $_POST['pages'] ?? null;
            $description = $_POST['description'] ?? null;
            $file_type = $_POST['file_type'] ?? null;
            $image = $_FILES['image_url'] ?? null;
            $book = $_FILES['book_url'] ?? null;
            $language = $_POST['language'] ?? null;
            // Use  Data Book After Prossing 
            $feedBackUploadImage = HandlingFiles::uploadImage($image, __DIR__ . '/../uploads/image_book/', 'uploads/image_book/');
            $feedBackUploadBook = HandlingFiles::uploadBook($book, __DIR__ . '/../uploads/book_url/', 'uploads/book_url/');
            if (isset($feedBackUploadBook['hasInputEmpty'])) {
                return  $feedBackUploadBook;
            }
            if (isset($feedBackUploadImage['hasInputEmpty'])) {
                return $feedBackUploadImage;
            }
            $file_size = $feedBackUploadBook['file_size'];
            $pathBook = $feedBackUploadBook['PathBook'];
            $pathImage = $feedBackUploadImage['pathImage'];
            $result = $this->modelBook->insertBook($bookName, $id_author, $year, $id_category, $pages, $description, $file_size, $pathImage, $pathBook, $language);
            if ($result) {
                return ['successAddBook' => 'تم إضافة الكتاب بنجاح'];
            } else {
                return ['NotsuccessAddBook' => 'فشل إضافة الكتاب'];
            }
        }
    }


    public   function search($name)
    {
        return $this->modelBook->search($name);
    }
    function getBookByCategory($id)
    {
        return $this->modelBook->loadBookByCateogryID($id);
    }
    function getInfoBookByID($idBook)
    {
        return $this->modelBook->infoBook($idBook);
    }
    function like($lik) {}
    function incrementDonwnload($id)
    {
        if (empty($id)) {
            return "فشل في تنزيل الكتاب";
        }
        $resultDownload = $this->modelBook->incrementDonwnload($id);
        return ($resultDownload) ? "تم تنزيل الكتاب" : "فشل في تنزيل الكتاب";
    }
    function incrementReadBook($id)
    {
        $this->modelBook->incrementReadBook($id);
    }
    public function OtherBooks()
    {
        $OtherBooks = $this->modelBook->LoadOtherBooks();
        if (empty($OtherBooks)) {
            return [];
        }
        return $OtherBooks;
    }
}
