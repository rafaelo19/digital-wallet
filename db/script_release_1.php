<?php
try {
    $sql = file_get_contents("./db/release-1.sql");
} catch (Throwable $e) {
    print_r($e->getMessage());
}

function connect(string $host, string $port, string $db, string $user, string $password): PDO
{
    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$db;";

        return new PDO(
            $dsn,
            $user,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

$host = getenv("DATABASE_HOST");
$port = getenv("DATABASE_PORT");
$user = getenv("DATABASE_USER");
$password = getenv("DATABASE_PASSWORD");
$db = getenv("DATABASE_NAME");

$pdo = connect($host, $port, $db, $user, $password);

try {
    $pdo->exec($sql);
} catch (Throwable $e) {
    print_r($e->getMessage());
}
exit();