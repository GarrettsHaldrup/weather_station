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

    echo "<h1>Recent Weather Readings</h1><table border='1'>";
    echo "<tr><th>ID</th><th>Temp (°C)</th><th>Humidity (%)</th><th>Pressure (hPa)</th><th>Time</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['temperature']}</td>
                <td>{$row['humidity']}</td>
                <td>{$row['pressure']}</td>
                <td>{$row['recorded_at']}</td>
              </tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>