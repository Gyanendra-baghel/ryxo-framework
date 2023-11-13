<?php

namespace Ryxo\Route;

class Group
{
    private $prefix_path;
    private $router;
    public function __constructor($prefix_path, $router)
    {
        $this->prefix_path = $prefix_path;
        $this->router = $router;
    }
    public function get($path)
    {
        $this->router->get($this->prefix_path . $path);
    }
    public function post($path)
    {
        $this->router->post($this->prefix_path . $path);
    }
    public function group($path, $callback)
    {
        call_user_func($callback, new Group($this->prefix_path . $path, $this));
    }
}
