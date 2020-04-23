def password_generator(length):
	'''
	Parameter: an integer which is the desired password length
	Returns: a string as the generated password consisting of alphanumerics only.
	'''
	assert type(length)==int and length>0,'Invalid length'
	import random
	if length < 8:
		print("You have a weak password")
	characters=list("qwertyuiop12345QWERTYUIOPasdfghjkl67890ZXCVBNMzxcvbnmASDFGHJKL")
	return "".join(random.choices(characters,k=length))


print(password_generator(10))

