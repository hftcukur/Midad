<?php
include_once('BaseModel.php');

class ModelUser extends BaseModel
{
    protected $database;
    function __construct($database)
    {
        parent::__construct($database, "users");
    }

    public function checkLogin($email, $password)
    {
        return true;
    }
    public function update($username, $email) {}
    function checkToken($token)
    {
        $queryToken = "SELECT * FROM users WHERE token = ?";
        $stmt = $this->database->prepare($queryToken);
        $stmt->execute([$token]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($result)){
            return false;
        }
        return $result;
    }
}
