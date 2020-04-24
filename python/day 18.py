def amicable(n1,n2):
	'''
	This function takes in two integers n1 and n2 and
	returns a boolean indicating whether they are amicable or not.
	'''
	assert type(n1) == int and n1 > 0, 'Invalid input'
	assert type(n2) == int and n2 > 0, 'Invalid input'
	divs = lambda n: sum(i for i in range(1,n//2+1) if n%i==0)
	return divs(n1)==n2 and divs(n2)==n1

#print(amicable(220,284))