<?php
include('CoreModel.php');
class ModelBook   extends CoreModel
{
  public function __construct($database,)
  {
    parent::__construct($database, 'books');
  }


  function insertBook($bookName, $id_author, $year, $id_category, $pages, $description, $file_size, $imgPathDB, $filePathDB, $language)
  {
    $QeruyinsertBook = "INSERT INTO books (title,pages,file_size,image,year,description,id_author,id_category,language,book_url)
    VALUES (?,?,?,?,?,?,?,?,?,?)
    ";
    $stmt = $this->database->prepare($QeruyinsertBook);
    return $stmt->execute([$bookName, $pages, $file_size, $imgPathDB, $year, $description, $id_author, $id_category, $language, $filePathDB]);
  }
  function  loadCategory()
  {
    $query = "SELECT * FROM category";
    $stmt = $this->database->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function join_books_authors()
  {
    $query = "SELECT books.id_book,books.title,books.image, books.id_author,authors.name
    FROM books JOIN authors ON authors.id_author = books.id_author";
    $stmt = $this->database->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function loadBookByCateogryID($id)
  {
    $query = "SELECT books.id_book,books.title,books.image, books.id_author,authors.name
    FROM books JOIN authors ON authors.id_author = books.id_author WHERE books.id_category = :id";
    $stmt = $this->database->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);;
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  function like($idUser, $idBook)
  {
    $queryLike = "INSERT INTO likes_book (id_user,id_book,likes) VALUES (???)";
    $stmt = $this->database->prepare($queryLike);
    $stmt->execute([$idUser, $idBook, 1]);
  }
  function infoBook($idBook)
  {
    $queryInfoBook = "
        SELECT books.id_book,books.readBook,books.downloads, books.title,books.image,books.pages,books.file_size,books.file_type,books.year,books.description,books.language,books.book_url,authors.name AS authorName,category.title_category
        FROM books
        JOIN authors ON authors.id_author = books.id_author
        JOIN category ON books.id_category = category.id_category
        WHERE books.id_book = :id
    ";
    $stmt = $this->database->prepare($queryInfoBook);
    $stmt->bindParam(':id', $idBook, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  function search($name) {}
  function incrementReadBook($id)
  {
    $queryIncrementReadBook = "UPDATE books SET readBook = COALESCE(readBook,0) + 1 WHERE id_book  = ?";
    $stmt = $this->database->prepare($queryIncrementReadBook);
    $stmt->execute([$id]);
  }
  function incrementDonwnload($id)
  {
    $queryIncrementDonwnload ="UPDATE books SET downloads = COALESCE(downloads,0) + 1 WHERE id_book = ?";
    $stmt = $this->database->prepare($queryIncrementDonwnload);
    $stmt->execute([$id]);
  }
}
