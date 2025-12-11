    <?php
    class ControllUser
    {
        protected $Model;
        public function __construct($Model)
        {
            $this->Model = $Model;
        }

        public function show()
        {
            $allUser = $this->Model->loadAll();
            return $allUser;
        }

        public function findByID($id)
        {
            $detailsUser = $this->Model->findByID($id);
        }
        public function insert($username, $email, $password)
        {
            if (empty($username) || empty($email) || empty($password)) {
                header("Location:register?errorMsg" . urldecode("خطاء يجب إدخال البيانات"));
                exit();
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location:register?errorMsg" . urldecode("لبريد الإلكتروني غير صالح"));
                exit();
            }
            $token = bin2hex(random_bytes(32));
            setcookie('remember_token', $token, time() + 86400 * 30, "/");
            $_SESSION['username'] = $username;
            $ok =  $this->Model->insert($username, $email, $password,$token);
            if($ok){
                header("Location:home");
            }
        }
        public function update($username, $email)
        {
            return $this->Model->update($username, $email);
        }

        public function delete($id)
        {
            return $this->Model->delete($id);
        }

        public function search($username)
        {
            $resultSearch = $this->Model->search($username);
        }
        public function isLoggedIn($email, $password)
        {

            $hashPassword = Encryption($password);
            if ($this->Model->checkLogin($email, $hashPassword)) {
                header("location:home");
                exit();
            } else {
                header("location: login?Message=" . urlencode("يرجاء انشاء حساب اولاُ"));
                exit();
            }
        }
        function checkToken($token)
        {
           return  $this->Model->checkToken($token);
        }
    }
