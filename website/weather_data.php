<?php
# Data Grabber for website
# Author: Garrett Haldrup
# Description: Takes times as input and returns all values from database within those times


$host = 'db';
$db   = 'weatherdb';
$user = 'weatheruser';
$pass = '1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

# Start and End times from site
$start = isset($_GET['start']) ? $_GET['start'] : null;
$end = isset($_GET['end']) ? $_GET['end'] : null;

if (!$start || !$end) {
    echo json_encode(["error" => "Missing start or end"]);
    exit;
}

try {
    $pdo = new PDO($dsn, $user, $pass);
    $stmt = $pdo->prepare("
        SELECT temperature, humidity, pressure, wind_speed, recorded_at FROM weather_data
        WHERE recorded_at BETWEEN :start AND :end 
        ORDER BY recorded_at DESC
    ");
    $stmt->execute([
        ':start' => $start,
        ':end' => $end
    ]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($data);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>