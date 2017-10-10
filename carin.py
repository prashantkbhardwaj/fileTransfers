from gpiozero import LightSensor
from time import sleep
from firebase import firebase

firebase = firebase.FirebaseApplication('https://trafficapp-43fae.firebaseio.com/')

ldr = LightSensor(4)  # alter if using a different pin
while True:
	sleep(0.1)
	if ldr.value < 0.5:
		state = firebase.get('/parking_spots/c21/', '4_freeSpots')
		now = state - 1
		firebase.patch('/parking_spots/c21/', {'4_freeSpots': now})		
	else: