<?php
$host = 'db';
$db   = 'weatherdb';
$user = 'weatheruser';
$pass = '1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $range = isset($_GET['range']) ? intval($_GET['range']) : 15;
    $pdo = new PDO($dsn, $user, $pass);
    $stmt = $pdo->prepare("
        SELECT * FROM weather_data
        WHERE recorded_at >= NOW() - INTERVAL :range MINUTE 
        ORDER BY recorded_at DESC
    ");
    $stmt->bindValue(':range', $range, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($data);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>