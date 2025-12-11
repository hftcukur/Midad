<?php
class CoreModel 
{
    protected $database;
    protected $table;
    function  __construct($database, $table)
    {
        $this->database = $database;
        $this->table = $table;
    }
    public function loadAll()
    {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->database->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findByID($id) {
        $queryFind = "";
    }
    public function delete() {}
    public function insert($username, $email, $password)
    {
        $query = "INSERT INTO $this->table (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->database->prepare($query);

        return $stmt->execute([$username, $email, $password]);
    }
}
