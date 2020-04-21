<?php

namespace JFGRomano\Ratchet;

use \JFGRomano\Core\WebSocket\Context;
use \Ratchet\ConnectionInterface;

interface RatchetObserverInterface{
    public function sendConnect(Context $context, $clients, ConnectionInterface $client);
    public function sendMessage(Context $context, $clients, ConnectionInterface $from, $msg);
    public function sendClose(Context $context, $clients, ConnectionInterface $client);
}
