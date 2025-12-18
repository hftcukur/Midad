<?php
class controllAdmin
{
    private $Model;
    function __construct($model)
    {
        $this->Model = $model;
    }
    function getAllAdmins()
    {
        return $this->Model->loadAll();
    }
    function addAdmin($username, $email, $password)
    {

        $this->Model->insert($username, $email, $password);
    }
    public function isLoggedIn($email, $password)
    {
        $email = strtolower(trim($email));
        $password = trim($password);
        if (empty($email)) {
            return ['emptyEmail' => 'يرجاء ملاء الحقل'];
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['invalidEmail' => 'غلط في البريد الالكتروني'];
        }
        if (empty($password)) {
            return ['emptyPass' => 'يرجاء ملاء الحقل'];
        }
        $lenghtPassword  = strlen($password);
        if ($lenghtPassword   < 10 || $lenghtPassword  > 15) {
            return ['lenghtPass' => 'يرجاء املا كلمة المرور  بين 10 و 15 حرف'];
        }
        $hashPassword = Encryption($password);

        if ($this->Model->checkLogin($email, $hashPassword)) {
            header("location:admin/home");
            exit();
        } else {
            return ['filedLogin' => 'انت لست مشرف الموقع'];
        }
    }
}
