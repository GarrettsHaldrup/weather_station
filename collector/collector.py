from time import sleep
import data_upload as du
import test_data as td


while True:
    data = td.get_fake_weather()

    du.upload(data['temperature'], data['humidity'], data['pressure'])

    sleep(30)