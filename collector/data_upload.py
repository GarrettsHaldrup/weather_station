import mysql.connector
import datetime
from time import sleep

def upload(temperature, humidity, pressure):
    # Try to connect to database
    while (1):
        try:
            conn = mysql.connector.connect(
                host="db",
                user="weatheruser",
                password="1234",
                database="weatherdb"
            )
            # Break from loop if succesfull
            break
        except Exception as e:
            print("Waiting for Database...", e)
            sleep(5)

    # Insert Data into database
    try:
        cursor = conn.cursor()
        cursor.execute("""
            INSERT INTO weather_data (temperature, humidity, pressure)
            VALUES (%s, %s, %s)
        """, (temperature, humidity, pressure))
        conn.commit()
        print(f"[{datetime.now()}] Inserted: temp: {temperature} humidity: {humidity} pressure: {pressure}")
        
    except Exception as e:
        print("Database error:", e)
        cursor.close()
        conn.close()
    finally:
        cursor.close()
        conn.close()

