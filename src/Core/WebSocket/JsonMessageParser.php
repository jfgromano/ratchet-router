<?php

namespace JFGRomano\Core\WebSocket;

class JsonMessageParser implements MessageParser
{
    public function __construct($routePath = ['route'], $dataPath = ['data'])
    {
        $this->routePath = $routePath;
        $this->dataPath = $dataPath;
    }

    public function parse(string $text): Message
    {
        $json = json_decode($text, true);

        $route = $this->navigateOnArray($json, $this->routePath);
        $data = $this->navigateOnArray($json, $this->dataPath);

        return new Message($route, $data);
    }

    private function navigateOnArray($array, $keys)
    {
        $value = $array;
        foreach ($keys as $k) {
            $value = $array[$k];
        }
        return $value;
    }
}
