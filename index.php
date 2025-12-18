    <?php
    session_start();
    
    include_once  'model/ModelBook.php';
    include_once  'model/ModelUser.php';
    include_once  'model/ModelAuthor.php';
    include_once  'model/ModelAdmin.php';
    include_once  'Controller/controllBook.php';
    include_once  'Controller/controllerAuthor.php';
    include_once  'Controller/controllAdmin.php';
    include_once  'Controller/ControllUser.php';
    include_once  'functions/functions.php';
    require_once  'database/database.php';

    $database  = databaseConnection();

    $ModelUser = new ModelUser($database);
    $controllUser = new ControllUser($ModelUser);
    $ModelAdmin = new ModelAdmin($database);
    $controllAdmin = new controllAdmin($ModelAdmin);
    $ModelBook = new ModelBook($database);
    $controllBook = new ControllBook($ModelBook);
    $ModelAuthor = new ModelAuthor($database);
    $controllAuthor = new ControllerAuthor($ModelAuthor);
    $URL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $parts = explode('/', $_SERVER['REQUEST_URI']);
    $query = $_GET['query'] ?? '';
    enum Route: string
    {
        case home = '/Madad/home';
        case books = '/Madad/books';
        case category = '/Madad/category';
        case search = '/Madad/search';
        case authors = '/Madad/authors';
        case register = '/Madad/register';
        case login = '/Madad/login';
        case book_ditles = '/Madad/book_ditles';
        case info_author = '/Madad/info_author';
        case profile = '/Madad/profile';
        case homePageAdmin = '/Madad/admin/home';
        case managemtAuthor = '/Madad/admin/magagement-atuhor';
        case ManagementUsers = '/Madad/admin/ManagementUsers';
        case addAuthor = '/Madad/admin/addAuthor';
        case pageAdmin = '/Madad/admin/admin';
        case pageAdminAddBook = '/Madad/admin/addBook';
        case pageAdminAddAdmin = '/Madad/admin/addAdmin';
        case updateBook = '/Madad/admin/update';
    }
    $route = [
        '/Madad/home' => 'home.php',
        '/Madad/books' => 'books.php',
        '/Madad/category' => 'category.php',
        '/Madad/search' => 'search.php',
        '/Madad/authors' => 'authors.php',
        '/Madad/register' => 'register.php',
        '/Madad/login' => 'login.php',
        '/Madad/book_ditles' => 'book_ditles.php',
        '/Madad/info_author' => 'info_author.php',
        '/Madad/profile' => 'profile.php',
        '/Madad/admin/home' => 'page-admin.php',
        '/Madad/admin/addAuthor' => 'addAuthor.php',
        '/Madad/admin/magagement-atuhor' => 'manageAuthor.php',
        '/Madad/admin/ManagementUsers' => 'ManagementUsers.php',
        '/Madad/admin/admin' => 'admin.php',
        '/Madad/admin/addBook' => 'addBook.php',
        '/Madad/admin/update' => 'updateBook.php',
        '/Madad/admin/addAdmin' => 'addAdmin.php',
    ];
    if (array_key_exists($URL, $route)) {
        switch ($URL) {
            case Route::home->value:
                $allBooks = $controllBook->getInfoBookAndAuthor();
                if ($_COOKIE['remember_token']) {
                    $getToken  = $controllUser->checkToken($_COOKIE['remember_token']);
                    $_SESSION['id_user'] = $getToken['id'];
                    $_SESSION['username'] = $getToken['username'];
                    $_SESSION['email'] = $getToken['email'];
                }

                require_once('view/' . $route[$URL]);
                break;
            case Route::books->value:
                $allBooks = $controllBook->getInfoBookAndAuthor();
                $allCategory = $controllBook->getAllCategory();
                if (isset($_GET['id_category'])) {
                    $id = $_GET['id_category'];
                    $bookByCategory = $controllBook->getBookByCategory($id);
                }
                require_once('view/' . $route[$URL]);
                break;
            case Route::authors->value:
                $allAuthor = $controllAuthor->getAll();
                require_once('view/' . $route[$URL]);
                break;
            case Route::register->value:
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_register'])) {
                    $error = $controllUser->insert($_POST['username'], $_POST['email'], $_POST['password']);
                }
                require_once('view/' . $route[$URL]);
                break;
            case Route::login->value:
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['login'])) {
                        if ($_POST['login-as'] == 'user') {
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $errorLogin = $controllUser->isLoggedIn($email, $password);
                        } else {
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $errorLogin = $controllAdmin->isLoggedIn($email, $password);
                        }
                    }
                }
                require_once('view/' . $route[$URL]);
                break;

            case Route::book_ditles->value:

                if ($_GET['bookID']) {
                    $id = $_GET['bookID'];
                }
                if (isset($_POST['idDownloadBook'])) {
                    $controllBook->incrementDonwnload($_POST['idDownloadBook']);
                }
                if (isset($_POST['idReadBook'])) {
                    $controllBook->incrementReadBook($_POST['idReadBook']);
                }
                $OtherBooks = $controllBook->OtherBooks();
                $infoBook = $controllBook->getInfoBookByID($id);
                require_once('view/' . $route[$URL]);
                break;
            case Route::info_author->value:
                if (isset($_GET['authroID'])) {
                    $id = $_GET['authroID'];
                }

                $infoAuthor = $controllAuthor->findByID($id);
                $allBooksAuthor = $controllAuthor->getBookAuthor($id);
                require_once('view/' . $route[$URL]);
                break;
            case Route::category->value:
                if (isset($_GET['id_category'])) {
                    $id = $_GET['id_category'];
                }
                $allCategory = $controllBook->getAllCategory();
                $category = $controllBook->getBookByCategory($id);
                require_once('view/' . $route[$URL]);
                break;
            case Route::search->value:
                if (isset($_GET['name'])) {
                    $name = $_GET['name'];
                }
                $allCategory = $controllBook->getAllCategory();
                $search = $controllBook->search($name);
                require_once('view/' . $route[$URL]);
                break;
            case Route::profile->value:
                require_once('view/' . $route[$URL]);
                break;
            // Admin
            case Route::homePageAdmin->value:
                $allBooks = $controllBook->getAll();
                require_once('admin/view/' . $route[$URL]);
                break;
            case Route::pageAdmin->value:
                $allAdmins = $controllAdmin->getAllAdmins();
                require_once('admin/view/' . $route[$URL]);
                break;
            case Route::pageAdminAddBook->value:
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBook'])) {
                    $bookName = $_POST['bookName'];
                    $year = $_POST['publish_year'];
                    $id_category = $_POST['id_category'];
                    $id_author = $_POST['id_author'];
                    $pages = $_POST['pages'];
                    $file_size = $_POST['file_size'];
                    $description = $_POST['description'];
                    $image = $_FILES['image_url'];
                    $book = $_FILES['book_url'];
                    $language = $_POST['language'];
                    $Message  = $controllBook->addBook($bookName, $id_author, $year, $id_category, $pages, $description, $image, $file_size, $language, $book);
                }
                $allCategory = $controllBook->getAllCategory();
                $authors = $controllAuthor->getAll();
                require_once('admin/view/' . $route[$URL]);
                break;
            case Route::pageAdminAddAdmin->value:
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['btnAddNewAdmin'])) {
                        $username = $_POST['adminName'];
                        $email = $_POST['adminEmail'];
                        $password = $_POST['adminPassword'];
                        $controllAdmin->addAdmin($username, $email, $password);
                    }
                }
                require_once('admin/view/' . $route[$URL]);
                break;
            case Route::managemtAuthor->value:
                $allAuthors = $controllAuthor->getAll();
                require_once('admin/view/' . $route[$URL]);
                break;
            case Route::addAuthor->value:
                if (isset($_POST['addauthor'])) {
                    $nameAuthor = $_POST['authorName'];
                    $imageURLAuthro = $_FILES['imageURLAuthro'];
                    $bioAuthro = $_POST['bio'];
                    $Message = $controllAuthor->addAuthor($nameAuthor, $imageURLAuthro, $bioAuthro);
                }
                require_once('admin/view/' . $route[$URL]);
                break;
            case Route::updateBook->value:
                if (isset($_POST['ID'])) {
                    $ID = $_POST['ID'];
                    $updateBook = $controllBook->getAll();
                }
                require_once('admin/view/' . $route[$URL]);
                break;
            case Route::ManagementUsers->value:
                $allUsers = $controllUser->show();
                require_once('admin/view/' . $route[$URL]);
                break;
            default:
                require_once('view/404.php');
        }
    } else {
        require_once('view/404.php');
    }
