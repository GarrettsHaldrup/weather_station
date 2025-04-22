# Wind Sensor Class
# Author: Garrett Haldrup
# Description: Class for the wind sensor to get wind speed data

from gpiozero import Button
import math
from datetime import datetime

class wind_sensor:
    def __init__(self, pin, rad=0.038):
        self.pin = pin
        self.speed = 0
        self.circ = 2 * math.pi * rad
        self.count = 0
        self.switch = Button(pin, pull_up=True)

    def get_speed(self, timeout=5):
        try:
            if not self.switch.wait_for_press(timeout=timeout):
                self.speed = 0
                return self.speed
            if not self.switch.wait_for_release(timeout=timeout):
                self.speed = 0
                return self.speed
            self.count = 1 + self.count
            if self.count == 1:
                self.time_one = datetime.now()
            elif self.count == 2:
                self.count = 0
                time_two = datetime.now()
                time_passed = time_two - self.time_one
                self.speed = (self.circ * 0.000621371)/ (time_passed.total_seconds() / 60 / 60)
                return self.speed
        except Exception as e:
            print(f"Wind Sensor Error: {e}")
            return 0