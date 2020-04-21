<?php

namespace JFGRomano\Core\WebSocket;

interface MessageParser{
    public function parse(string $text): Message;
}