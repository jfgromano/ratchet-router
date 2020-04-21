<?php

namespace JFGRomano\Ratchet;

use JFGRomano\Core\WebSocket\Context;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class RatchetDriver implements MessageComponentInterface
{
    protected $clients;
    protected $observer;
    protected $context;

    public function __construct(Context $context, RatchetObserverInterface $observer)
    {
        $this->clients = [];
        $this->observer = $observer;
        $this->context = $context;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients["$conn->resourceId"] = $conn;
        $this->observer->sendConnect($this->context, $this->clients, $conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $this->observer->sendMessage($this->context, $this->clients, $from, $msg);
    }

    public function onClose(ConnectionInterface $conn)
    {
        unset($this->clients["$conn->resourceId"]);
        $this->observer->sendClose($this->context, $this->clients, $conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }
}
