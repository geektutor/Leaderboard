def is_Nigerian(number):
    '''
    Parameters:
        A string containing a number to be tested
    Returns:
        A boolean indicating whether the number is a valid Nigerian number or not
    '''
    assert number[0] in '0+' and number[1:].isnumeric(),'The number entered is invalid'
    head=number[:-10]
    x = number[-10:-8] in ['70','80','81','90']
    y= head in [ '0','+234','(+234)' ]
    z= len(number) in [11,14,16]
    return x and y and z

'''

#Testcases
print(is_Nigerian('08180454128'))
print(is_Nigerian('+2348180454128'))
print(is_Nigerian('08880454128'))
print(is_Nigerian('+2347780454128'))
print(is_Nigerian('081804128'))
print(is_Nigerian('18045412081'))
print(is_Nigerian('081804rt128'))
'''