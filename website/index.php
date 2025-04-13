<h1>Live Weather Data</h1>
<table border="1" id="weather-table">
    <thead>
        <tr><th>Temp (°C)</th><th>Humidity (%)</th><th>Pressure (hPa)</th><th>Time</th></tr>
    </thead>
    <tbody></tbody>
</table>
<h2>Temperature Graph</h2>
<img src="graph.png?<?php echo time(); ?>" width="600" />

<script>
function loadWeather() {
    fetch('weather_data.php')
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector("#weather-table tbody");
            tbody.innerHTML = "";
            data.forEach(row => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    
                    <td>${row.temperature}</td>
                    <td>${row.humidity}</td>
                    <td>${row.pressure}</td>
                    <td>${row.recorded_at}</td>
                `;
                tbody.appendChild(tr);
            });
        });
}

loadWeather();                   
setInterval(loadWeather, 5000); 

setInterval(() => {
    const img = document.querySelector("img");
    const ts = new Date().getTime();
    img.src = `graph.png?${ts}`;
}, 30 * 1000);
</script>