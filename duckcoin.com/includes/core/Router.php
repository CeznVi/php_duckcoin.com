<?php


namespace App;


// site.com/main/index
// site.com/main/shop?key=value&id=5
// site.com/nature/index
// site.com/nature
// site.com

class Router
{
    private $defaultControllerName = __NAMESPACE__."\\"."MainController";
    private $errorControllerName = __NAMESPACE__."\\"."ErrorController";
    private $defaultActionName = "Index";

    private $controllerName = null;
    private $actionName = null;

    public $controller = null;

    public function Start() {
        //varSuperDump($_SERVER["REQUEST_URI"]);
        $routes = explode("?", $_SERVER["REQUEST_URI"])[0];
        $routes = explode('/', $routes);

        // change controller---------------------------------start
        if(empty($routes[1])) {         //если доступ в корень сайта
            $this->controllerName = $this->defaultControllerName;
        } else {
            $this->controllerName = ucfirst(mb_strtolower($routes[1]));
            $this->controllerName = $this->controllerName."Controller";
            if(!file_exists(CONTROLLERS_PATH.$this->controllerName.EXT)) {   //если такой контроллер есть у нас
                $this->controllerName = $this->errorControllerName;
            } else {
                $this->controllerName = __NAMESPACE__."\\".$this->controllerName;
            }
        }

        //создаем экземпляр класса контроллера
        $this->controller = new $this->controllerName();
        // change controller---------------------------------end

        // change action of class---------------------------------start
        $this->actionName = $this->defaultActionName;
        if(!empty($routes[2])) {
            if(method_exists($this->controller, $routes[2])) {  //если метод у класса есть
                $this->actionName = mb_strtolower($routes[2]);
            }
        }
        $this->controller->call($this->actionName);
        // change action of class---------------------------------end
    }
}