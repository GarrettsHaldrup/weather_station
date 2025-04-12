<?php
$host = 'db';
$db   = 'weatherdb';
$user = 'weatheruser';
$pass = '1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $stmt = $pdo->query("SELECT * FROM weather_data ORDER BY recorded_at DESC LIMIT 10");

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($data);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>