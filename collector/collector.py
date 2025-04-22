# Sensor Data Collector Script
# Author: Garrett Haldrup
# Description: Gets data from all sensors and sends to database

from time import sleep
import data_upload as du
import test_data as td
from wind_speed import wind_sensor
from dht_bmp import dht_bmp

ws = wind_sensor(21)
dv = dht_bmp()

while True:
    data = td.get_fake_weather()
    print("Trying for dht vals")
    result = dv.get_vals()
    print(result)
    print("Trying for Speed Vals")
    speed = ws.get_speed(timeout=1)
    print(speed)
    if result == None or speed == None:
        continue
    du.upload(round(result[0], 2), round(result[1], 2), round(result[2], 2), round(speed, 2))

    sleep(30)