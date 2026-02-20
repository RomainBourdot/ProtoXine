<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use ProtoXine\App\Controllers\AuthController;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

} catch (Exception $e) {
    die("Erreur de configuration : Le fichier .env est manquant ou invalide.");
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
try {
    switch ($uri){
        case("/login"):
            new AuthController()->login();
            break;
    }
} catch (Exception $e) {
    $code = $e->getCode() === 404 ? 404 : 500;
    http_response_code($code);
}

