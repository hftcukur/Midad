<?php 
class controllAdmin  
{
     private $Model ;
     function __construct($model)
     {
        $this->Model = $model;
     }
    function getAllAdmins()
    {
        return $this->Model->loadAll();
    }
    function addAdmin($username, $email, $password)  {

         $this->Model->insert($username, $email, $password);
    }
    public function isLoggedIn($email, $password)
    {
        
        if ($this->Model->checkLogin($email,$password)) {

            header("location:admin/home");
            exit();
        } else {
            header("location:login?Message=" . urlencode("البريد ا كلمة المرور خاطئة"));
        }
    }
  
}
