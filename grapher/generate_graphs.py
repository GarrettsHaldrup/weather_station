import matplotlib.pyplot as plt
from datetime import datetime
from scripts.connector import connect_to_db
from time import sleep

def select_data(name):
    conn = connect_to_db()
    range_min = 15

    try:
        with open("/var/www/html/range.txt", "r") as f:
            range_min = int(f.read().strip())
    except Exception as e:
        print("Could not read file:", e)

    cursor = conn.cursor()
    cursor.execute(f"SELECT recorded_at, {name} FROM weather_data WHERE recorded_at >= NOW() - INTERVAL %s MINUTE ORDER BY recorded_at DESC", (range_min,))
    rows = cursor.fetchall()
    cursor.close()
    conn.close()   
    return rows

def create_graph(name):
    if (name == "temperature"):
        y_label = "C"
    elif (name == "humidity"):
        y_label = "%"
    elif (name == "pressure"):
        y_label = "hPa"
    else:
        y_label = "unit"

    rows = select_data(name)
    rows.reverse()
    times = [r[0].strftime("%H:%M:%S") for r in rows]
    data = [r[1] for r in rows]

    plt.figure(figsize=(10, 5))
    plt.plot(times, data, marker='o')
    plt.title(name)
    plt.xlabel('Time')
    plt.xticks(rotation=60)
    plt.ylabel(y_label)
    plt.tight_layout()
    plt.savefig(f"/var/www/html/graph_{name}.png")


create_graph("temperature")
create_graph("humidity")
create_graph("pressure")

print(f"[{datetime.now()}] Graphs updated!")