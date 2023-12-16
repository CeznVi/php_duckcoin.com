<?php


namespace App;


class AboutController extends Controller
{
    public function Index()
    {
        View::render(
            PAGES_PATH . 'about' . EXT, $this->data
        );
    }

    public function ContactUs()
    {
        View::render(
            PAGES_PATH . 'contactus' . EXT, $this->data
        );
    }

    function ErrorPage()
    {
        View::render(
            PAGES_PATH.'error0'.EXT, $this->data
        );
    }


    public function sendClienMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            //varSuperDump($_GET);
            if (
                !empty($_GET['name']) &&
                !empty($_GET['email']) &&
                !empty($_GET['phone']) &&
                !empty($_GET['message'])
            ) {

                $name = htmlspecialchars(trim($_GET['name']));
                $email = htmlspecialchars(trim($_GET['email']));
                $phone = htmlspecialchars(trim($_GET['phone']));
                $message = htmlspecialchars(trim($_GET['message']));

                $clientMessModel = new ClientMessageModel();
                if ($clientMessModel->saveMessage($name, $email, $phone, $message)) {
                    // если оно сохранен
                    $this->data['succsess'] = "Повідомлення отримано, найближчим часом ми з вами зв'яжемось";
                } else {
                    $this->data['error'] = "Якась хрінь";
                }

                $this->ContactUs();
            }
            else
                $this->ErrorPage();
        }
    }
}