<?php

namespace App;

class AdminController extends Controller
{
    public function Index()
    {
        if(UserAutorization::isUserLoginAsAdmin()) {

            View::render(
                PAGES_PATH . 'admin/mainAdmin' . EXT, $this->data
            );

            exit;
        } else {
            header('Location: /account');
        }

    }

    public function createOption() {
        if(!UserAutorization::isAutuh()) header('Location: /account');

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!empty($_POST['name']) &&
                !empty($_POST['value']) &&
                isset($_POST['groupBy'])) {

                $optM = new OptionModel();
                $newData = [
                    'name' => $_POST['name'],
                    'value' => $_POST['value'],
                    'groupBy' => $_POST['groupBy']
                ];

                if($optM->addParam($newData)) {
                    $this->data['succsess'] = "Опцію успішно створено";

                } else {
                    $this->data['warning'] = "Опцію не створено";
                }

                $this->format_option();
                $this->Index();
            }
        }


    }

    public function updateOption()
    {
        if(!UserAutorization::isAutuh()) header('Location: /account');
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if (
                !empty($_POST['Id']) &&
                !empty($_POST['name']) &&
                !empty($_POST['value']) &&
                !empty($_POST['action']) &&
                isset($_POST['groupBy'])
            ) {

                switch ($_POST['action']) {
                    case "remove": {
                        $optModel = new OptionModel();

                        if($optModel->removeOption($_POST['Id'])) {
                            $this->data['succsess'] = "Опцію успішно видалено";
                        } else {
                            $this->data['warning'] = "Опцію не видалено";
                        }
                        $this->format_option();
                        $this->Index();

                        break;
                    }
                    case "update": {
                        $updData = [
                            'name' => $_POST['name'],
                            'value' => $_POST['value'],
                            'groupBy' => $_POST['groupBy']
                        ];
                        $optModel = new OptionModel();

                        if($optModel->updateParam($_POST['Id'], $updData)){
                            $this->data['succsess'] = "Опцію успішно оновлено";
                        } else {
                            $this->data['warning'] = "Опцію не оновлено";
                        }
                        $this->format_option();
                        $this->Index();
                        break;
                    }
                    default: {

                    }
                }
            }
        }
    }
}