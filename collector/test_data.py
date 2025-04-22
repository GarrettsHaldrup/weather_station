# Test Data
# Author: Garrett Haldrup
# Description: Generate Random data to test databsae and website before sensors

from random import uniform

def get_fake_weather():
    return{
        'temperature': round(uniform(20.0, 30.0), 2),
        'humidity': round(uniform(40.0, 70.0), 2),
        'pressure': round(uniform(990.0, 1020.0), 2)
    }