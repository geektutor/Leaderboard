def captains_room(room_nos):
	'''
	This function takes in a list of room numbers and
	Returns the room number that appears just once.
	'''
	assert type(room_nos)==list,'Invalid input'
	counter = lambda x: sum(1 for i in room_nos if i==x)
	dic = {counter(i):i for i in room_nos}
	return dic[1]

#print(captains_room([1,1,1,1,1,2,2,3,4,5,5,7,7,8,8,9]))