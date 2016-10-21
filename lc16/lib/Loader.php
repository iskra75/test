<?php
class Loader {
    
    private $request_uri, $router;

    public function __construct($request_uri = '/')
    {
        $this->request_uri = $request_uri;
    }

    public function run()
    {
        $this->router = new Router($this->request_uri);

        $controllerName = ucfirst($this->router->controller)."Controller";
        $actionName = "{$this->router->action}Action";

        if(method_exists($controllerName, $actionName)){
            $controller = new $controllerName();
            $controllerData = $controller->$actionName();
            
            $view = new View("{$this->router->controller}/{$this->router->action}", $controllerData);
            $viewContent = $view->render();

        } else {
            throw new Exception("No $actionName in $controllerName class");
        }

        $layout = new View(null, $viewContent);
        echo $layout->render();
    }
}