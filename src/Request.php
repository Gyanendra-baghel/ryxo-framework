<?php

namespace Ryxo;

class Request
{
  public $path;
  public $method;
  public $body = [];
  public $params = [];

  function __construct()
  {
    $this->path = strtolower($_SERVER["REQUEST_URI"]) ?? "/";
    $this->method = strtolower($_SERVER["REQUEST_METHOD"]);
    $this->body = $this->getParam();
  }
  private function getUrlParam()
  {
    $params = array();
    foreach ($_GET as $key => $value) {
      $params[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    return $params;
  }
  public function getParam()
  {
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
      return $this->getUrlParam();
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $body = array();
      foreach ($_POST as $key => $value) {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
      return $body;
    }
  }
  public function redirect($redirect)
  {
    if (!is_null($redirect)) {
      header("Location:{$redirect}");
      exit;
    }
  }
  public function __destruct()
  {
    if (isset($this->params["redirect"])) $this->redirect($this->params["redirect"]);
  }
}
