<?php


namespace App;


abstract class Controller
{
    abstract function Index();

    public function __construct()
    {
        $this->format_option();
        $this->format_navigate();

        $this->data['error'] = null;
        $this->data['succsess'] = null;
        $this->data['warning'] = null;
    }

    public function call($method)
    {
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            throw new \Exception("Method incorrect");
        }
    }

    // данные для рендера
    protected $data = [];

    protected function format_navigate() {
        $this->data['navigate'] = [];
        $navModel = new NavigateModel();
        $navigate = $navModel->getAllNav();

        for ($i = 0; $i < count($navigate); $i++)   {
            if(empty($navigate[$i]['parentId'])) {              //это элемент верхнего уровня
                $navigate[$i]['childs'] = [];
                array_push($this->data['navigate'], $navigate[$i]);
            }
        }
        for ($r = 0; $r < count($this->data['navigate']); $r++){
            for($c = 0; $c < count($navigate); $c++) {
                if(!empty($navigate[$c]['parentId']) && $navigate[$c]['parentId'] == $this->data['navigate'][$r]['Id']) {
                    array_push($this->data['navigate'][$r]['childs'], $navigate[$c]);
                }
            }
        }
    }

    protected function format_option() {
        $this->data['options'] = [];
        $optModel = new OptionModel();
        foreach ($optModel->getAllOptions() as $key => $value) {
            $this->data['options'][$value['name']] = $value;
        }
    }
}

