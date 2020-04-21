<?php

namespace JFGRomano\Core\Router;

class WebSocketRouter{
    public const ROUTE_DISCONNECT = '/@websocket/disconnect';
    public const ROUTE_CONNECT = '/@websocket/connect';

    protected function callController($routes, $route, ...$parameter){
        if(isset($routes[$route]) === false){
            if($this->routeNotFound($routes, $route, ...$parameter) === false){
                return;
            }
        }

        if(is_array($routes[$route])){
            $controllers = $routes[$route];
        }else{
            $controllers = [$routes[$route]];
        }

        foreach ($controllers as $controllerPath) {
            $arrController = explode("@", $controllerPath);
            $class = $arrController[0];
            $method = $arrController[1];
            $instance = new $class();
            call_user_func(array($instance, $method), ...$parameter);
        }
    }

    protected function routeNotFound($routes, $route, ...$parameter){
        return false;
    }
}