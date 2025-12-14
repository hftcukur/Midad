<?php
class ModelAuthor
{
  private $database;
  function __construct($database)
  {
    $this->database = $database;
  }

  function insert($nameAuthor, $pathImage, $bio)
  {
    $queryAddAuthor  = "INSERT INTO 	authors (name,image,bio) VALUES (?,?,?)";
    $stmt = $this->database->prepare($queryAddAuthor);
    return $stmt->execute([$nameAuthor, $pathImage, $bio]);
  }
  public function loadAll()
  {
    $query = "SELECT * FROM authors";
    $stmt = $this->database->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function loadBookByAuthorID($id)
  {
    $query = "SELECT books.id_book,books.title,books.image, books.id_author,authors.name
    FROM books JOIN authors ON authors.id_author = books.id_author WHERE books.id_author = :id
    
    ";
    $stmt = $this->database->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);;
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function findByID($id)
  {
    $queryFind = "SELECT authors.id_author,authors.name,authors.image,authors.bio ,COUNT(books.id_book) as total_book, COALESCE(SUM(books.downloads), 0) AS total_downloads FROM authors
    JOIN books on books.id_author = authors.id_author 
     where authors.id_author = ?
     GROUP BY authors.id_author
     ";
    $stmt = $this->database->prepare($queryFind);
    $stmt->execute([$id]);
    $author = $stmt->fetch(PDO::FETCH_ASSOC);
    return $author;
  }
}
