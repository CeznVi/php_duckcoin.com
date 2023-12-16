<?php

namespace App;

class UserAutorization
{
    private static $currentUser = null;

    public static function isUserValid($email, $passord) {
        $userM = new UserModel();
        $user = $userM->getUser($email,$passord);

        if(!is_null($user)) {
            self::$currentUser = $user;
            return true;
        } else {
            return false;
        }
    }

    public static function getUserInfo() {
        return self::$currentUser;
    }

    public static function clearUserInfo() {
        self::$currentUser = null;
    }

    public static function isAutuh() {
        if(isset($_SESSION['ip']) && isset($_SESSION['login'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function isEmailUniqe($email): bool {
        $userM = new UserModel();
        return $userM->checkUniqueEmail($email);
    }

    public static function isLoginUniqe($login): bool
    {
        $userM = new UserModel();
        return $userM->checkUniqueLogin($login);
    }

    public static function Register($email, $login, $pass): bool{
        $userM = new UserModel();
        return $userM->AddUser($email, $login, $pass);
    }

    public static function checkAdminRole(): bool {
        $userM = new UserModel();
        return $userM->checkUserRole($_SESSION['login']);
    }

    public static function isUserLoginAsAdmin(): bool {
        if(self::isAutuh() && self::checkAdminRole()) {
            return true;
        }
        else
            return false;
    }
}