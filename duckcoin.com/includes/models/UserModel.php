<?php

namespace App {
    class UserModel extends DbEngine
    {
            public function __construct()
            {
                parent::__construct('users');
            }

            public function getUser($email, $password) {
                $usersResullt = $this->getManyRows([
                    'email' => $email,
                    'password' => $password
                ]);

                if(count($usersResullt) == 1) {
                    return $usersResullt[0];

                } else {
                    return null;
                }
            }

            ///Перевірити в базі чи існує в ній користувач з таким email
            public function checkUniqueEmail($email): bool
            {
                $rez = $this->getManyRows([
                    'email' => $email
                ]);

                if(count($rez) > 0) {
                    return false;
                } else {
                    return true;
                }
            }

        ///Перевірити в базі чи існує в ній користувач з таким логіном
        public function checkUniqueLogin($login): bool
        {
            $rez = $this->getManyRows([
                'login' => $login
            ]);

            if(count($rez) > 0) {
                return false;
            } else {
                return true;
            }
        }

        ////Добавить пользователя в базу
        public function AddUser($email, $login, $pass) {
                return $this->addRow([
                    'email' => $email,
                    'login' => $login,
                    'password' => $pass
                ]);

        }

        ////Проверить является ли пользователь админом
        public  function checkUserRole($login):bool {
            $usersResullt = $this->getManyRows([
                'login' => $login,
                'role' => 'admin'
            ]);

            if(count($usersResullt) == 1) {
                return true;

            } else {
                return false;
            }
        }
    }
}