def find_Armstrong(x,y):
	'''
	find_Armstrong is based on a definition for armstrong numbers that involves
	summing the cubes of the digits in the number.
	Parameters:
		x: an integer representing the start of the interval
		y:an integer representing the last number in the interval
	Returns:
		A list of all the armstrong numbers in the interval
	'''
	assert type(x)==int and type(y)==int and 0<=x<y,'Wrong range input'
	if x>1000: return []
	if y>1000: y=1000
	arm= lambda num: sum(int(n)**3 for n in str(num))==num
	return list(filter(arm,range(x,y+1)))
	

'''
print(find_Armstrong(-50,-100))
print(find_Armstrong(1,1000))
print(find_Armstrong(10000,10000000000))
print(find_Armstrong(152,153))
print(find_Armstrong(152,1520000))
'''