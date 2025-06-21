<?php
// Exibe erros (apenas para desenvolvimento)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Carrega constantes e inicia sessão
require_once __DIR__ . '/app/config/constants.php';
session_start();

// Captura a URL amigável
$url = isset($_GET['url']) ? trim($_GET['url'], '/') : 'home';
$urlParts = explode('/', $url);

// Rotas fixas para login/logout
if ($urlParts[0] === 'login') {
    require_once __DIR__ . '/app/controllers/AuthController.php';
    $controller = new AuthController();
    $controller->login();
    exit;
}
if ($urlParts[0] === 'logout') {
    require_once __DIR__ . '/app/controllers/AuthController.php';
    $controller = new AuthController();
    $controller->logout();
    exit;
}

// Controller e método dinâmicos
$controllerBase = preg_replace('/[^a-zA-Z0-9]/', '', ucfirst($urlParts[0] ?? 'home'));
$controllerName = $controllerBase . 'Controller'; // Ex: ClientesController
$method = $urlParts[1] ?? 'index';
$params = array_slice($urlParts, 2);
$controllerPath = __DIR__ . '/app/controllers/' . $controllerName . '.php';

// Controllers públicos (sem necessidade de login)
$publicControllers = ['AuthController', 'HomeController'];

// Protege rotas privadas (painel/admin)
if (!isset($_SESSION['colaborador']) && !in_array($controllerName, $publicControllers)) {
    header('Location: ' . BASE_URL . 'login');
    exit;
}

// Suporte a endpoints AJAX: /modulo/pesquisarAjax
if (preg_match('/^pesquisarAjax$/i', $method)) {
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $method)) {
                $controller->$method(...$params);
                exit;
            }
        }
    }
    header("HTTP/1.0 404 Not Found");
    echo "Endpoint AJAX não encontrado: <b>$method</b> em $controllerName";
    exit;
}

// Controller padrão
if (file_exists($controllerPath)) {
    require_once $controllerPath;
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $method) && is_callable([$controller, $method])) {
            call_user_func_array([$controller, $method], $params);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "Método não encontrado: <b>$method</b> em $controllerName";
        }
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Classe do controller não existe: <b>$controllerName</b>";
    }
} else {
    // Se a URL for vazia ou 'home', exibe a home
    if ($url === 'home' || $url === '') {
        require_once __DIR__ . '/app/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Controller não encontrado!<br>";
        echo "Esperado: $controllerPath<br>";
    }
}
