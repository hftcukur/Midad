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
        return  $allBooks = $this->modelBook->join_books_authors();
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
    public function addBook($bookName, $authorName, $publish_year, $category, $pages, $description, $image, $file_size, $path, $bookURL)
    {
        $fileName = $image['name'];
        $tmpName = $image['tmp_name'];
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($extension, $allowed)) {
            $newName = uniqid() . "." . $extension;
            $folderBooks = __DIR__ . '/../uploads/book_url/';
            $folder = __DIR__ . '/../uploads/image_book/';
            $path = 'uploads/image_book/' . $newName;
            $pathBooks = "uploads/book_url" . $bookURL;

            move_uploaded_file($tmpName, $folder . $newName);
            move_uploaded_file($pathBooks, $folderBooks . $pathBooks);
        }


        return $this->modelBook->insertBook($bookName, $authorName, $publish_year, $category, $pages, $description, $file_size, $path);
    }

    public function search($name)
    {
        return $this->modelBook->searchBook($name);
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
}
