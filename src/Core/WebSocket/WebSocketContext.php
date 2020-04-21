<?php

namespace JFGRomano\Core\WebSocket;

class WebSocketContext implements Context{
    public function __construct()
    {
        $this->data = [];
    }
    
    public function get($key){
        return $this->data[$key];
    }

    public function set($key, $value){
        $this->data[$key] = $value;
        return $this;
    }
}