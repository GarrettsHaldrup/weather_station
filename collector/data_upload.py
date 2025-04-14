import datetime
from scripts.connector import connect_to_db

def upload(temperature, humidity, pressure):
    # Try to connect to database
    
    conn = connect_to_db()

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

