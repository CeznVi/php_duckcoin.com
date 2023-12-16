<?php

namespace App;

class BlogController extends Controller
{

    ///кол-во постов на одной странице
    const POST_PER_PAGE = 6;

    ///количесво постов в базе
    var $countAllPost = 0;
    ///текущий индекс пагинации
    var $postIndex = 0;
    ///количество страниц пагинации
    var $countPages = 0;


    ////Загрузить все данные через модель в дату
    protected function LoadPosts($skip = 0, $limit = 1000, $order = "DESC") {
        $postModel = new PostModel();
        $this->countAllPost = $postModel->getCountPost();

        /// !! Проверка пользователя на админа для записи в дату булевого значения
        if(UserAutorization::isUserLoginAsAdmin()) {
            $this->data['isUserIsAdmin'] = true;
        } else {
            $this->data['isUserIsAdmin'] = false;
        }

        //так как отчет ведетмя с нуля отнимаем 1
        $this->countPages = ceil($this->countAllPost / self::POST_PER_PAGE) - 1;

        ///загрузка в дату всех постов
        $this->data['posts'] = $postModel->getAllposts($order,'Id', $limit, $skip);
        ///Загрузка в дату количества страниц пагинации
        $this->data['countPages'] = $this->countPages;
        ///Загрузка в дату текущий индекс пагинации
        $this->data['postIndex'] = $this->postIndex;
    }

    public function Index()
    {
        ///// запустить метода загрузки из базі
        $this->LoadPosts(0, self::POST_PER_PAGE);


        View::render(
            PAGES_PATH . 'blog' . EXT, $this->data
        );
    }

    public function History() {
        $this->Index();
    }

    public function getPosts() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (!empty($_GET['page'])) {
                    $this->postIndex = $_GET['page'];

                    $skipPost = $this->postIndex * self::POST_PER_PAGE;

                    $this->LoadPosts($skipPost, self::POST_PER_PAGE);

                    if(count($this->data['posts']) > 0) {
                        View::render(
                            PAGES_PATH . 'blog' . EXT, $this->data
                        );
                    }
                    else {
                        $this->data['error'] = "Шо занадто то не добре.";
                        $this->ErrorPage();
                    }
            } else {
                $this->Index();
            }
        }
    }


    public function Post(){
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (!empty($_GET['id'])) {
                $postModel = new PostModel();

                $post = $postModel->getOnePostById($_GET['id']);

                if(count($post) > 0) {

                    /// !! Проверка пользователя на админа для записи в дату булевого значения
                    if(UserAutorization::isUserLoginAsAdmin()) {
                        $this->data['isUserIsAdmin'] = true;
                    } else {
                        $this->data['isUserIsAdmin'] = false;
                    }

                    $this->data['post'] = $post;
                    View::render(
                       PAGES_PATH . 'onePost' . EXT, $this->data
                    );

                } else {
                    $this->ErrorPage();
                }
            } else {
                $this->ErrorPage();
            }
        }
    }

    public function deletePost(){
        if(UserAutorization::isUserLoginAsAdmin() && $_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['id'])) {
            $postM = new PostModel();
            if($postM->deletePost($_GET['id'])) {
                $this->data['succsess'] = "Пост успішно видалено";
            } else {
                $this->data['error'] = "Пост не вдалось видалити";
                $this->Index();
            }


            $this->Index();
        } else {
            $this->ErrorPage();
        }
    }

    public function createPost() {
        if(UserAutorization::isUserLoginAsAdmin()) {
                /// !! Проверка пользователя на админа для записи в дату булевого значения
                if (UserAutorization::isUserLoginAsAdmin()) {
                    $this->data['isUserIsAdmin'] = true;
                } else {
                    $this->data['isUserIsAdmin'] = false;
                }

                $categoryModel = new CategoriesModel();
                $this->data['categories'] = $categoryModel->getAllCategory();
                $this->data['post'] = [0];
                $this->data['post'][0] =
                [
                    'Id' => null,
                    'title' => "",
                    'categoryId' => "-1",
                    'imageLink' => "",
                    'content' => ""
                ];
                View::render(
                    PAGES_PATH . 'postRedactor' . EXT, $this->data
                );

        } else {
            $this->ErrorPage();
        }
    }

    public function editPost() {
        if(UserAutorization::isUserLoginAsAdmin() && $_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['id'])) {
            $postModel = new PostModel();

            $post = $postModel->getOnePostById($_GET['id']);

            if(count($post) > 0) {

                /// !! Проверка пользователя на админа для записи в дату булевого значения
                if (UserAutorization::isUserLoginAsAdmin()) {
                    $this->data['isUserIsAdmin'] = true;
                } else {
                    $this->data['isUserIsAdmin'] = false;
                }

                $categoryModel = new CategoriesModel();
                $this->data['categories'] = $categoryModel->getAllCategoryWithoutId($post[0]['categoryId']);
                $this->data['post'] = $post;
                View::render(
                    PAGES_PATH . 'postRedactor' . EXT, $this->data
                );
            }
        } else {
            $this->ErrorPage();
        }

    }

    public function saveEditChanges() {
        if($_SERVER['REQUEST_METHOD'] == "POST" &&
            UserAutorization::isUserLoginAsAdmin() &&
            !empty($_POST['title']) &&
            !empty($_POST['categoryId']) &&
            !empty($_POST['imageLink']) &&
            !empty($_POST['content'])) {

            $data = [
                'title' => $_POST['title'],
                'categoryId' => $_POST['categoryId'],
                'imageLink' => $_POST['imageLink'],
                'content' => $_POST['content'],
                'dateOfCreation' => date("Y-m-d H:i:s")
            ];

            if($_POST['Id'] != null) {
                $id = $_POST['Id'];

                $postM = new PostModel();
                if($postM->editPost($id, $data)) {
                    $this->data['succsess'] = "Данні посту успішно змінено";

                    $postModel = new PostModel();

                    $post = $postModel->getOnePostById($id);
                    /// !! Проверка пользователя на админа для записи в дату булевого значения
                    if (UserAutorization::isUserLoginAsAdmin()) {
                        $this->data['isUserIsAdmin'] = true;
                    } else {
                        $this->data['isUserIsAdmin'] = false;
                    }

                    $this->data['post'] = $post;
                    View::render(
                        PAGES_PATH . 'onePost' . EXT, $this->data
                    );
                } else {
                    $this->data['warning'] = "Данні посту не змінено";
                    $this->Index();
                }
            }
            else {

                $postM = new PostModel();
                if($postM->addPost($data)) {
                    $this->data['succsess'] = "Пост створено";
                    header('Location: /blog');
                    exit;
                } else {
                    $this->data['warning'] = "Пост не створено";
                    header('Location: /blog');
                    exit;
                }
            }

        } else {
            $this->ErrorPage();
        }
    }

    function ErrorPage()
    {
        View::render(
            PAGES_PATH.'error0'.EXT, $this->data
        );
    }

}