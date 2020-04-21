<?php

namespace JFGRomano\Core\WebSocket;

interface Context{
    public function get($key);
    public function set($key, $value);
}