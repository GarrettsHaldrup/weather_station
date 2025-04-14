<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/main.js"></script>
<link rel="stylesheet" href="style.css">

<h1>Live Weather Data</h1>
<form id="range-form">
  <label for="start">Start:</label>
  <input type="datetime-local" id="start">

  <label for="end">End:</label>
  <input type="datetime-local" id="end">

  <button type="button" id="range-submit">Apply</button>
</form>

<table border="1" id="weather-table">
    <thead>
        <tr><th>Temp (°C)</th><th>Humidity (%)</th><th>Pressure (hPa)</th><th>Time</th></tr>
    </thead>
    <tbody></tbody>
</table>
<div>
    <h2>Temperature</h2>
    <canvas id="tempChart" height="100"></canvas>
    <h2>Humidity</h2>
    <canvas id="humidityChart" height="100"></canvas>
    <h2>Temperature</h2>
    <canvas id="pressureChart" height="100"></canvas>
</div<
