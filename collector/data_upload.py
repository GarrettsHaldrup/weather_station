# Data Upload Script
# Author: Garrett Haldrup
# Description: Uploads inputed data to the database

from datetime import datetime
from scripts.connector import connect_to_db

def upload(temperature, humidity, pressure, wind_speed):
    # Try to connect to database
    
    conn = connect_to_db()

    # Insert Data into database
    try:
        cursor = conn.cursor()
        cursor.execute("""
            INSERT INTO weather_data (temperature, humidity, pressure, wind_speed)
            VALUES (%s, %s, %s, %s)
        """, (temperature, humidity, pressure, wind_speed))
        conn.commit()
        print(f"[{datetime.now()}] Inserted: temp: {temperature} humidity: {humidity} pressure: {pressure} wind speed: {wind_speed}")
        
    except Exception as e:
        print("Database error:", e)
        cursor.close()
        conn.close()
    finally:
        cursor.close()
        conn.close()

