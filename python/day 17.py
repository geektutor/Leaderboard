def abundant(number):
	'''
	Parameter:
		number: An integer greater than zero.
	Returns:
		A boolean indicating whether the number is True or False
	'''
	assert type(number)==int and number>0,'We dont do negatives here...'
	z= number//2
	perfectdiv= [u for u in range(1,z+1) if number%u==0]
	return sum(perfectdiv) > number
	
#print(abundant(220))

def sum_abundant(num):
	'''
	Parameter:
		num: a positive integer representing the number of abundant numbers to be summed starting from the first
	Returns:
		An integer representing the sum of the first n abundant numbers.
	'''
	assert type(num)==int and num>0,'We dont do negatives here...'
	n=12
	count=0
	summer=0
	while count<num:
		if abundant(n):
			summer+=n
			count+=1
		n+=1
	return summer
	
#print(sum_abundant(10))
#print(sum_abundant(125))