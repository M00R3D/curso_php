<?php
// crearUsr.php
// Función para crear usuario desde el formulario de pagBusqueda.php
// Uso: require 'crearUsr.php'; $res = crearUsr($_POST);

function getPdo(): PDO {
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "cursophp";
    $host = $db_host; // <- ajustar
    $db   = $db_name; // <- ajustar
    $user = $db_user;       // <- ajustar
    $pass = $db_pass;    // <- ajustar
    $dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $opts = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    return new PDO($dsn, $user, $pass, $opts);
}

/**
 * Crear usuario.
 * Espera un array con keys: username, email, password (puede recibir $_POST).
 * Devuelve array: ['ok' => bool, 'msg' => string, 'id' => int|null]
 */
function crearUsr(array $data): array {
    // Normalizar entradas
    $username = isset($data['username']) ? trim($data['username']) : '';
    $email    = isset($data['email']) ? trim($data['email']) : '';
    $password = isset($data['password']) ? $data['password'] : '';

    // Validaciones básicas
    if ($username === '' || $email === '' || $password === '') {
        return ['ok' => false, 'msg' => 'Faltan campos obligatorios.', 'id' => null];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['ok' => false, 'msg' => 'Email inválido.', 'id' => null];
    }
    if (strlen($password) < 6) {
        return ['ok' => false, 'msg' => 'La contraseña debe tener al menos 6 caracteres.', 'id' => null];
    }

    try {
        $pdo = getPdo();

        // Comprobar usuario existente por email o username
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email OR username = :username LIMIT 1');
        $stmt->execute([':email' => $email, ':username' => $username]);
        if ($stmt->fetch()) {
            return ['ok' => false, 'msg' => 'Usuario o email ya registrado.', 'id' => null];
        }

        // Insertar usuario
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password, created_at) VALUES (:username, :email, :password, NOW())');
        $stmt->execute([':username' => $username, ':email' => $email, ':password' => $hash]);

        return ['ok' => true, 'msg' => 'Usuario creado correctamente.', 'id' => (int)$pdo->lastInsertId()];
    } catch (PDOException $e) {
        // No exponer detalles en producción
        return ['ok' => false, 'msg' => 'Error al crear usuario: ' . $e->getMessage(), 'id' => null];
    }
}