import mysql.connector
from time import sleep
def connect_to_db():
    while (1):
        try:
            conn = mysql.connector.connect(
                host="db",
                user="weatheruser",
                password="1234",
                database="weatherdb"
            )
            # Break from loop if succesfull and Return conn
            return conn
        except Exception as e:
            print("Waiting for Database...", e)
            sleep(5)