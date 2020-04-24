def fibonacci(n):
    '''
    fibonacci sequence: [0,1,1,2,3,5,8,13....]
    Parameter:
        n: an integer >0
    Return:
        The nth nujmber in the fibonacci sequence
    '''
    if n==1:
        return 0
    elif n==2:
        return 1
    else:
        return fibonacci(n-1)+fibonacci(n-2)
#print(fibonacci(7))