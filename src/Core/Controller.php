<?php

namespace ProtoXine\App\Core;

abstract class Controller
{
    protected function render(string $view, array $data = []): void {
        extract($data);

        ob_start();
        require_once __DIR__ . "/../Views/$view.php";
        $content = ob_get_clean();

        require_once __DIR__ . "/../Views/layouts/main.php";
    }
}