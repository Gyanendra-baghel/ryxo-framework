<?php

namespace Ryxo;

class Controller
{
  public Response $response;
  public function __construct()
  {
    $this->response = new Response();
  }
  public function render($view, $param = [])
  {
    echo $this->response->render($view, $param);
  }
}
