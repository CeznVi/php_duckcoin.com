<?php
    function getOption($key) {
        $options = [
            'lang' => 'ua',
            'title' => 'Мой первый суперблог',
            'author' => 'Roma'
        ];
        // var_dump($options);
        // isset()              //проверка на существование переменной
        // empty()              //проверка на то что она есть и не пустая
        if(!empty($key) && !empty($options[$key])) {
            return $options[$key];
        } else return null;
    }

    function varSuperDump($data = null) {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }

    function getNavBar() {
        //данные условно вытянутые из бд
        $navigate = [
            ["Id" => 1, 'title'=> 'Главная', 'href'=>'/', 'order' => 1, 'parentId' => null],
            ["Id" => 2, 'title'=> 'Блог', 'href'=>'/blog', 'order' => 2, 'parentId' => null],
            ["Id" => 3, 'title'=> 'Новости', 'href'=>'/blog/news', 'order' => 1, 'parentId' => 2],
            ["Id" => 4, 'title'=> 'Архив', 'href'=>'/blog/archive', 'order' => 2, 'parentId' => 2],
            ["Id" => 5, 'title'=> 'О Нас', 'href'=>'/about/', 'order' => 3, 'parentId' => null],
            ["Id" => 6, 'title'=> 'Связаться с нами', 'href'=>'/about/contactus', 'order' => 1, 'parentId' => 5]
        ];

        // формируем свой формат данных которые будем рендерить
        $navBar = [];
        for ($i = 0; $i < count($navigate); $i++)   {
            if(empty($navigate[$i]['parentId'])) {              //это элемент верхнего уровня
                $navigate[$i]['childs'] = [];
                array_push($navBar, $navigate[$i]);
            }
        }
        for ($r = 0; $r < count($navBar); $r++){
            for($c = 0; $c < count($navigate); $c++) {
                if(!empty($navigate[$c]['parentId']) && $navigate[$c]['parentId'] == $navBar[$r]['Id']) {
                    array_push($navBar[$r]['childs'], $navigate[$c]);
                }
            }
        }

        return $navBar;
    }

    //varSuperDump(getNavBar());

