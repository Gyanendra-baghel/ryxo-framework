<?php

namespace Ryxo;

class Response
{
  public $path;
  public $method;

  public function __construct()
  {
  }

  public function json($array)
  {
    echo json_encode($array);
  }

  public function render($view, $vars = [])
  {
    foreach ($vars as $key => $value) {
      $$key = $value;
    }

    $body = $this->renderView($view, $vars);
    ob_start();
    include BASE_PATH . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "_layout.php";
    return ob_get_clean();
  }

  public function renderView($_view, $_vars = [])
  {
    foreach ($_vars as $_key => $_value) {
      if (is_string($_key)) {
        $$_key = $_value;
      }
    }

    $viewPath = BASE_PATH . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $_view . ".php";

    if (file_exists($viewPath)) {
      ob_start();
      include $viewPath;
      return ob_get_clean();
    } else {
      // Handle error, maybe log it or render a default error view
      return "View not found: $_view";
    }
  }

  public function render404()
  {
    http_response_code(404);
    $this->renderView('_404');
  }

  public function setStatusCode($int)
  {
    http_response_code($int);
  }
}
