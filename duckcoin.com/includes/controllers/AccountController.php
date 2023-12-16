<?php

namespace App;

class AccountController extends Controller
{
    function Index()
    {
        $this->loginIn();
    }

    function loginIn()
    {
        if(UserAutorization::isAutuh() && UserAutorization::checkAdminRole()) {
            header('Location: /admin');
        } else {
            if(UserAutorization::isAutuh()) {
            $this->data['warning'] = "кабінет користувача тимчасово не доступний";
            View::render(
                PAGES_PATH.'main'.EXT, $this->data
            );
            exit;
            }
        }

        View::render(
            PAGES_PATH.'loginin'.EXT, $this->data
        );
    }

    public function checkUser() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(!empty($_POST['email']) && !empty($_POST['password'])) {

                $email = htmlspecialchars(trim($_POST['email']));
                $password = trim($_POST['password']);
                $password = hash("sha256", $password);

                if(UserAutorization::isUserValid($email, $password)) {
                    $_SESSION['login'] = UserAutorization::getUserInfo()['login'];
                    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

                    header('Location: /admin');
                    exit;
                }
            }
        }
        $this->data['error'] = "Данні не коректні";
        $this->loginIn();
    }


    function register()
    {
        View::render(
            PAGES_PATH.'register'.EXT, $this->data
        );
    }

    function forgotPassword()
    {
        View::render(
            PAGES_PATH.'forgotpassword'.EXT
        );
    }

    function logout()
    {
        unset($_SESSION['ip']);
        unset($_SESSION['login']);
        session_destroy();
        UserAutorization::clearUserInfo();
        header('Location: /account');
    }

    public function checkUserRegisterInfo() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['login'])) {

                $email = htmlspecialchars(trim($_POST['email']));
                $login = htmlspecialchars(trim($_POST['login']));
                if(UserAutorization::isEmailUniqe($email) && UserAutorization::isLoginUniqe($login)) {
                    $password = trim($_POST['password']);
                    $password = hash("sha256", $password);

                    if(UserAutorization::Register($email,$login,$password)) {
                        if(UserAutorization::isUserValid($email, $password)) {
                            $_SESSION['login'] = UserAutorization::getUserInfo()['login'];
                            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

                            header('Location: /');
                            exit;
                        }
                    }


                } else {
                    $this->data['error'] = "некоректна електронна пошта або логін";
                    $this->register();
                }
            }
        } else {
            $this->data['error'] = "Дані не коректні спробуйте ще раз";
            $this->register();
        }
    }



}