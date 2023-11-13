# Ryxo Framework

## Introduction

Welcome to the documentation for the Ryxo Framework. Ryxo is a lightweight PHP framework designed to provide a simple yet powerful foundation for building web applications.

## Getting Started

### Installation

To install Ryxo, follow these steps:

1. Clone the repository: `git clone https://github.com/gyanendra-baghel/ryxo.git`
2. Install dependencies: `composer install`

### Configuration

- **Autoloading:** Ryxo follows the PSR-4 autoloading standard. Make sure the `App` namespace points to your `app/` directory.

```json
"autoload": {
    "psr-4": {
        "App\\": "app/"
    }
}
```

### Routing

Define routes in the `routes.php` file:

```php
// routes.php
$app->get('/', [SiteController::class,'index');
$app->get('/blogs/{id}',function($req, $res, $params){
    // ...
});
```

### Templating

Ryxo includes a basic templating engine. Views are located in the `app/views` directory.

### Run the Application

Run the built-in PHP server:

```bash
php -S localhost:8000 -t public
```

Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Features

### Routing

Ryxo provides a simple routing system to handle HTTP requests. Define routes in the `routes.php` file using the `get` and `post` methods.

```php
$app->get('/path', Controller::class,'method');
```

### Templating

The included templating engine allows you to render views easily. Use the `render` method in your controllers.

```php
// Inside a controller method
return $this->response->render('viewName', ['data' => $data]);
```

### Controllers

Create controllers in the `app/Controllers` directory. Controllers handle the logic for specific routes.

```php
// Example HomeController
namespace App\Controllers;
use Ryxo\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->response->render('home');
    }
}
```

## Contributing

We welcome contributions to Ryxo! Follow the guidelines in the [CONTRIBUTING.md](CONTRIBUTING.md) file.

## License

Ryxo is open-source software licensed under the [MIT License](https://opensource.org/license/mit/).

## Support

For support, please open an issue on the [GitHub repository](https://github.com/gyanendra-baghel/ryxo-framework/issues).