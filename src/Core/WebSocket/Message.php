<?php

namespace JFGRomano\Core\WebSocket;

class Message{
    protected $messageArray;
    protected $route;
    protected $date;

    public function __construct($route, $array = [])
    {
        $this->messageArray = $array;
        $this->route = $route;
        $this->date = time();
    }

    public function getRoute(){
        return $this->route;
    }

    public function getMessageArray(){
        return $this->messageArray;
    }

    public function getDate(){
        return $this->date;
    }

    public function get($key){
        return $this->messageArray[$key];
    }

    public function toString(){
        return json_encode([
            'route' => $this->getRoute(),
            'data' => $this->getMessageArray(),
            'date' => $this->getDate()
        ]);
    }
}