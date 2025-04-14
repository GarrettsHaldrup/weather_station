<h1>Live Weather Data</h1>
<form id="range-form">
    <label for="range">Show data from:</label>
    <select id="range">
        <option value="5">Last 5 minutes</option>
        <option value="15" selected>Last 15 minutes</option>
        <option value="30">Last 30 minutes</option>
        <option value="60">Last 1 hour</option>
    </select>
</form>

<table border="1" id="weather-table">
    <thead>
        <tr><th>Temp (°C)</th><th>Humidity (%)</th><th>Pressure (hPa)</th><th>Time</th></tr>
    </thead>
    <tbody></tbody>
</table>
<div id="loading" style="display: none; color: gray;">
    Updating graphs...
</div>
<div id="graph" style="display: block;">
    <h2>Temperature Graph</h2>
    <img  src="graph_temperature.png?<?php echo time(); ?>" width="600" />
</div>
<div id="graph" style="display: block;">
    <h2>Humidity Graph</h2>
    <img  src="graph_humidity.png?<?php echo time(); ?>" width="600" />
</div>
<div id="graph" style="display: block;">
    <h2>Pressure Graph</h2>
    <img  src="graph_pressure.png?<?php echo time(); ?>" width="600" />
</div>

<script>
function getRange() {
    return document.getElementById("range").value;
}

function loadWeather() {
    const range = getRange()
    fetch(`weather_data.php?range=${range}`)
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

function update() {
    const range = getRange();
    document.getElementById("loading").style.display = "block";
    document.getElementById("graph").style.display = "none";
    fetch(`set_range.php?range=${range}`);
    fetch(`graph_update.php?range=${range}`)
        .then(res => res.json())
        .then(data => {


            setTimeout(() => {
                document.getElementById("loading").style.display = "none";
                document.getElementById("graph").style.display = "block";
            }, 500);
            const ts = new Date().getTime();
            document.querySelectorAll("img").forEach(img => {
                if (img.src.includes("graph_")) {
                    img.src = img.src.split('?')[0] + "?" + ts;
                }
            });
            loadWeather();
        });

    
}

document.getElementById("range").addEventListener("change", () => {
    update(); 
});

update();                   
setInterval(update, 30000); 
</script>