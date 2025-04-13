import matplotlib.pyplot as plt
from datetime import datetime
from scripts.connector import connect_to_db
from time import sleep

while (1):
    conn = connect_to_db()

    cursor = conn.cursor()
    cursor.execute("SELECT recorded_at, temperature FROM weather_data ORDER BY recorded_at DESC LIMIT 10")
    rows = cursor.fetchall()
    cursor.close()
    conn.close()

    rows.reverse()
    times = [r[0].strftime("%H:%M:%S") for r in rows]
    temps = [r[1] for r in rows]

    plt.figure(figsize=(6, 3))
    plt.plot(times, temps, marker='o')
    plt.title('Temperature')
    plt.xlabel('Time')
    plt.xticks(rotation=60)
    plt.ylabel('C')
    plt.tight_layout()
    plt.savefig("/var/www/html/graph.png")
    print(f"[{datetime.now()}] Graph updated!")
    sleep(30)