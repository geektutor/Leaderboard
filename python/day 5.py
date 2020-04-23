def modulo(n):
    '''
    Parameters:
    A positive integer n
    Returns:
    A string containing the results of successive
    modulo division on n
    '''
    assert type(n)== int and n>0,'The number entered is invalid.'
    if n==1:
        return '1'
    else:
        return str(n%2)+modulo(n//2) 
def faithful(n):
    '''
    Faithful numbers are numbers that can be represented as a
    sum of distinct powers of 7.
    Parameters:
    A positive integer n
    Returns:
    The nth faithful number.
    '''
    x = modulo(n)
    faith = 0
    for i in range(len(x)):
        if x[i]=='1':
            faith+= 7**i
    return faith
def main():
    print(faithful(1000000))
    ##print(faithful('r'))
    ##print(faithful(-5))
    ##print(faithful(5.5))
    ##print(faithful(1000000))













 
