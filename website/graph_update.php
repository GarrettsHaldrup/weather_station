<?php
$output = shell_exec("docker exec weather_station-grapher-1 python3 /app/genertate_graphs.py");
echo json_encode(["status" => "ok", "output" => $output]);
?>