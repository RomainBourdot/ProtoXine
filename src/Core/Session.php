<?php
namespace ProtoXine\App\Core;

class Session {

    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function setUser(array $user): void {
        $_SESSION['user'] = $user;
    }

    public static function getUser(): ?array {
        return $_SESSION['user'] ?? null;
    }

    public static function isAdmin(): bool {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }
}