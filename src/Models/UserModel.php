<?php

namespace ProtoXine\App\Models;
use ProtoXine\App\Config\Database;

class UserModel
{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function getByEmail(string $email): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }

    public function create(string $email, string $password, string $firstName, string $lastName): bool {
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password, first_name, last_name) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$email, password_hash($password, PASSWORD_BCRYPT), $firstName, $lastName]);
    }
}