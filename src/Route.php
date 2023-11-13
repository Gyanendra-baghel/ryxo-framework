<?php

namespace Ryxo;

use Ryxo\Route\Group;

class Route
{
  private $request;
  private $response;
  public $routes = ["get" => [], "post" => []];
  private $allowedMethods = ["get", "post"];

  function __construct()
  {
    $this->request = new Request;
    $this->response = new Response;
  }

  public function get($path, $callback)
  {
    $this->addRoute('get', $path, $callback);
  }

  public function post($path, $callback)
  {
    $this->addRoute('post', $path, $callback);
  }
  public function any($path, $callback)
  {
    $this->addRoute('get', $path, $callback);
    $this->addRoute('post', $path, $callback);
  }

  private function addRoute($method, $path, $callback)
  {
    if (!in_array($method, $this->allowedMethods)) {
      // Throw an exception or handle invalid method
      return;
    }

    $this->routes[$method][$path] = $callback;
  }

  public function group($path, $callback)
  {
    call_user_func($callback, new Group($path, $this));
  }

  public function run()
  {
    $urlPath = $this->request->path;
    $method = $this->request->method;

    $routes = $this->routes[$method];

    foreach ($routes as $route => $callback) {
      $pattern = $this->buildPattern($route);
      if (preg_match($pattern, $urlPath, $matches)) {
        $this->handleRouteCallback($callback, $matches);
        return;
      }
    }

    $this->response->render404();
  }

  private function buildPattern($route)
  {
    // Convert {param} to a regex capturing group
    $pattern = preg_replace('/\{(\w+)\}/', '(?<$1>[^/]+)', $route);
    return "/^" . preg_replace(["/\//"], ['\/'], $pattern) . "$/i";
  }

  private function handleRouteCallback($callback, $matches)
  {
    array_shift($matches);
    if (is_string($callback)) {
      echo $this->response->render($callback);
    } elseif (is_array($callback)) {
      echo call_user_func_array([new $callback[0], $callback[1]], [$this->request, $this->response, $matches]);
    } else if (is_callable($callback)) {
      echo call_user_func_array($callback, [$this->request, $this->response, $matches]);
    } else {
      echo $this->response->render404();
    }
  }
}
