def gcd(n1,n2):
    '''
    This function takes in 2 integers n1 and n2 greater than zero and
    returns their greatest common divisor.
    '''
    assert type(n1)==type(n2)==int,'Non integers entered.'
    assert n1>0 and n2>0,'Only positive numbers are allowed.'
    low= n1 if n1<n2 else n2
    while True:
        if n1%low == n2%low == 0:
            break
        low-=1
    return low
print(gcd(9,8))