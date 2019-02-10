<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $route_path=ROOT.'/config/routes.php';
        $this->routes= include($route_path);
    }
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run()
    {
        $uri=$this->getURI();
        foreach ($this->routes as $uri_pattern=>$path) {
             if(preg_match("~$uri_pattern~", $uri)) {

                $internal_route= preg_replace("~$uri_pattern~", $path, $uri);
                $q_builder= explode('/', $internal_route);
                array_shift($q_builder);
                $controller_name=array_shift($q_builder).'Controller';
                $function_name=ucfirst(array_shift($q_builder));
                $controller_file=ROOT.'/controller/'.$controller_name.'.php';
                $parametrs=$q_builder;

                if(file_exists($controller_file)) {
                    include_once ($controller_file);
                }
                $new_controller_object = new $controller_name;
                $create_object_controller= call_user_func_array(array($new_controller_object, $function_name), $parametrs);
                if($create_object_controller != null)
                break;
            }
        }
    }

}