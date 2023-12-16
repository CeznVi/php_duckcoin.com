<?php

namespace App;

class ClientMessageModel extends DbEngine
{
    public function __construct()
    {
        parent::__construct('clientmessage');
    }

    public function saveMessage($name, $email, $phone, $message) {

        $curDate = getdate();
        $data = [];
        $data =  ["name" => $name,
                  'date' => $curDate["year"]."-".$curDate["mon"]."-".$curDate["mday"]."-".$curDate["hours"]."-".$curDate["minutes"]."-".$curDate["seconds"],
                  'email'=> $email,
                  'phone'=> $phone,
                  'message'=> $message
        ];

        if($this->addRow($data)) {
            return true;
        } else {
            return false;
        }


    }

}