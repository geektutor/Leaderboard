def closest_power(base,num):
    '''
    base: int>1
    num: int >0
    Finds the integer component such that base**exponent is close to num.
    Note that the base**exponent may either be greater or smaller than num. In
    case of a tie, return the smaller value.
    returns: the exponent(an integer).
    '''
    assert type(base)==type(num)==int,'Non integers in input'
    assert base>1 and num>0,'Invalid base or number'
    n=0
    diff = {}
    while (num - (base**n)) >0 :
        x=abs(num - (base**n))
        diff[n] = x
        n+=1
    diff[n] =  abs(num - base**(n))
    em = [k for k,v in diff.items() if v==min(diff.values())]
    return min(em)
print(closest_power(10,1000))