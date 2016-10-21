<?php

class Router
{
    public $controller = 'index';
    public $action = 'index';

    public function __construct($request_uri)
    {
        $params = explode('/', $request_uri);

        if(isset($params[1]) && $params[1] != ''){
            $this->controller = $params[1];

            if(isset($params[2])){
                $this->action = $params[2];
            }
        }
    }
}