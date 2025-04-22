# Weather Station Sensor Script
# Author: Zach Bricker
# Description: Reads temperature (F), humidity (%), and pressure (hPa) from DHT11 and BMP280 sensors using CircuitPython libraries

import time
import board
import adafruit_dht
import adafruit_bmp280


class dht_bmp:
    def __init__(self):
        # DHT11 Setup (GPIO 4)
        self.dht = adafruit_dht.DHT11(board.D4)
        self.i2c = board.I2C()

        # BMP280 Setup (I2C Address 0x76)
        self.bmp = adafruit_bmp280.Adafruit_BMP280_I2C(self.i2c, address=0x76)
        self.bmp.sea_level_pressure = 1013.25

    def get_vals(self):
        try:
            temperature_dht = self.dht.temperature
            humidity = self.dht.humidity
            temperature_bmp = self.bmp.temperature
            pressure = self.bmp.pressure


            temp_dht_f = (temperature_dht * 9 / 5) + 32
            temp_bmp_f = (temperature_bmp * 9 / 5) + 32

            result = [temp_bmp_f, humidity, pressure]

            print("DHT Temp: {:.1f} °F | Humidity: {:.1f} %".format(temp_dht_f, humidity))
            print("BMP Temp: {:.1f} °F | Pressure: {:.2f} hPa".format(temp_bmp_f, pressure))
            print("--------------------------------------------")
            return result
        except Exception as e:
            print("Sensor error:", e)
            return None
