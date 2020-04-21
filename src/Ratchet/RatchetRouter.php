<?php

namespace JFGRomano\Ratchet;

use JFGRomano\Core\Router\WebSocketRouter;
use JFGRomano\Core\WebSocket\Context;
use JFGRomano\Core\WebSocket\MessageParser;
use Ratchet\ConnectionInterface;

class RatchetRouter extends WebSocketRouter implements RatchetObserverInterface{
    protected $routes;
    protected $messageParser;
    
    public function __construct($routes, MessageParser $messageParser){
        $this->routes = $routes;
        $this->messageParser = $messageParser;
    }
    
    public function sendConnect(Context $context, $clients, ConnectionInterface $client){
        $this->callController($this->routes, WebSocketRouter::ROUTE_CONNECT, $context, $clients, $client);
    }

    public function sendMessage(Context $context, $clients, ConnectionInterface $from, $msg){
        $message = $this->messageParser->parse($msg);
        $this->callController($this->routes, $message->getRoute(), $context, $clients, $from, $message);
    }

    public function sendClose(Context $context, $clients, ConnectionInterface $client){
        $this->callController($this->routes, WebSocketRouter::ROUTE_DISCONNECT, $context, $clients, $client);
    }
}