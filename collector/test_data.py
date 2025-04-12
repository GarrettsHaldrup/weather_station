import mysql.connector
from random import uniform
from time import sleep
from datetime import datetime

def get_fake_weather():
    return{
        'temperature': round(uniform(20.0, 30.0), 2),
        'humidity': round(uniform(40.0, 70.0), 2),
        'pressure': round(uniform(990.0, 1020.0), 2)
    }

print("Before conn loop")

while True:
    
    try:
        conn = mysql.connector.connect(
            host="db",
            user="weatheruser",
            password="1234",
            database="weatherdb"
        )
        break
    except Exception as e:
        print("Waiting for database...", e)
        sleep(5)

print("Before data loop")

while True:
    data = get_fake_weather()
    try:
        cursor = conn.cursor()
        cursor.execute("""
            INSERT INTO weather_data (temperature, humidity, pressure)
            VALUES (%s, %s, %s)
        """, (data['temperature'], data['humidity'], data['pressure']))
        conn.commit()
        print(f"[{datetime.now()}] Inserted: {data}")
        
    except Exception as e:
        print("Database error:", e)
        cursor.close()
        conn.close()

    sleep(5)