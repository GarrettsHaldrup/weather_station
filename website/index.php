<?php
# Main Website Layout
# Author: Garrett Haldrup
# Description: Imports needed javascript and laysout html for main.js
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/main.js"></script>
<link rel="stylesheet" href="style.css">
<title>Pi Weather Station</title>

<h1>Live Weather Data</h1>
<form id="range-form">
  <label for="start">Start:</label>
  <input type="datetime-local" id="start">

  <label for="end">End:</label>
  <input type="datetime-local" id="end">

  <button type="button" id="range-submit">Apply</button>
</form>

<div id="headerSection">
    <h2>Data Table</h2>
    <button class="toggle-btn" onclick="toggleSection('weather-table')">Toggle Table</button>
</div>
<div id="weather-table" class="toggle-target">
  <table border="1">
      <thead>
          <tr><th>Temp (°C)</th><th>Humidity (%)</th><th>Pressure (hPa)</th><th>Wind Speed (mph)</th><th>Time</th></tr>
      </thead>
      <tbody></tbody>
  </table>
</div>

<div id="headerSection">
    <h2>Temperature</h2>
    <button class="toggle-btn" onclick="toggleSection('tempSection')">Toggle Temperature Graph</button>
</div>
<div id="tempSection" class="toggle-target">
  <canvas id="tempChart" height="100"></canvas>
</div>

<div id="headerSection">
    <h2>Humidity</h2>
    <button class="toggle-btn" onclick="toggleSection('humiditySection')">Toggle Humidity Graph</button>
</div>
<div id="humiditySection" class="toggle-target">
  <canvas id="humidityChart" height="100"></canvas>
</div>


<div id="headerSection">
    <h2>Pressure</h2>
    <button class="toggle-btn" onclick="toggleSection('pressureSection')">Toggle Pressure Graph</button>
</div>
<div id="pressureSection" class="toggle-target">
  <canvas id="pressureChart" height="100"></canvas>
</div>


<div id="headerSection">
    <h2>Wind Speed</h2>
    <button class="toggle-btn" onclick="toggleSection('windSection')">Toggle Wind Speed Graph</button>
</div>
<div id="windSection" class="toggle-target">
  <canvas id="windChart" height="100"></canvas>
</div>

<script>
  function toggleSection(id) {
    const el = document.getElementById(id);
    el.classList.toggle("hidden");
  }
</script>
