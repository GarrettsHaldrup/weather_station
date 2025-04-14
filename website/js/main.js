document.addEventListener("DOMContentLoaded", () => {
    let tempChart, humidityChart, pressureChart;


    function getRange() {
        return {
            start: document.getElementById("start").value,
            end: document.getElementById("end").value
        }
    }

    function update() {
        const {start, end} = getRange();
        fetch(`weather_data.php?start=${start}&end=${end}`)
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

                const times = data.map(row => row.recorded_at).reverse();
                const temperature = data.map(row => row.temperature);
                const humidity = data.map(row => row.humidity);
                const pressure = data.map(row => row.pressure);

                updateChart("tempChart", "Temperature (C)", times, temperature, tempChart, chart => tempChart = chart);
                updateChart("humidityChart", "Humidity (%)", times, humidity, humidityChart, chart => humidityChart = chart);
                updateChart("pressureChart", "Pressure (hPa)", times, pressure, pressureChart, chart => pressureChart = chart);



            });
    }

    function updateChart(id, label, labels, data, existingChart, setChartFn) {
        if (existingChart) existingChart.destroy();
        const ctx = document.getElementById(id).getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    borderWidth: 2,
                    tension: 0.3,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { ticks: { maxRotation: 45, minRotation: 30}},
                    y: { beginAtZero: false}
                }
            }
        });
        setChartFn(chart);
    }

    document.getElementById("range-submit").addEventListener("click", update);
    
    
    // Initial Loading of Page
    const now_udt = new Date();
    const now = new Date(now_udt.getTime() - 4 * 60 * 60 * 1000);
    const past = new Date(now.getTime() - 15 * 60 * 1000);
    
    document.getElementById("end").value = now.toISOString().slice(0,16);
    document.getElementById("start").value = past.toISOString().slice(0,16);

    update();
    setInterval(update, 30000);
});