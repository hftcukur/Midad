<?php
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
    function getInfoBookAndAuthor()
    {
        return $this->modelBook->join_books_authors();
    }
    function getAllCategory()
    {
        return $this->modelBook->loadCategory();
    }
    public function findByID($id)
    {

        return $this->modelBook->findByID($id);
    }
    public function deleteBook($id)
    {

        return $this->modelBook->deleteBook($id);
    }
    public function updateBook($id, $bookName, $authorName, $publish_year, $category, $pages, $description, $path)
    {

        return  $this->modelBook->updateBook($id, $bookName, $authorName, $publish_year, $category, $pages, $description, $path);
    }
    public function addBook($bookName, $id_author, $year, $id_category, $pages, $description, $image, $file_size, $language, $bookURL)
    {
        $imgName = $image['name'];
        $imgTmp  = $image['tmp_name'];
        $imgExt  = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($imgExt, $allowed)) {
            return "خطأ في تحميل الصورة";
        }
        if (empty($bookName) || empty($id_author) || empty($year) || empty($id_category) || empty($pages) || empty($image) || empty($bookURL)) {
            return "يرجاء إدخال التفاصيل";
        }
        $newImg = uniqid() . "." . $imgExt;
        $imgFolder = __DIR__ . '/../uploads/image_book/';
        $imgPathDB = 'uploads/image_book/' . $newImg;

        move_uploaded_file($imgTmp, $imgFolder . $newImg);

        $fileName = $bookURL['name'];
        $fileTmp  = $bookURL['tmp_name'];
        $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $newFile = uniqid() . "." . $fileExt;
        $fileFolder = __DIR__ . '/../uploads/book_url/';
        $filePathDB = 'uploads/book_url/' . $newFile;

        move_uploaded_file($fileTmp, $fileFolder . $newFile);

        $result = $this->modelBook->insertBook($bookName, $id_author, $year, $id_category, $pages, $description, $file_size, $imgPathDB, $filePathDB, $language);

        if ($result) {
            return "تم إضافة الكتاب";
        }

        return "فشل الإضافة";
    }

    public function search($name)
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
    function incrementReadBook($id){
        $this->modelBook->incrementReadBook($id);
    }
}
