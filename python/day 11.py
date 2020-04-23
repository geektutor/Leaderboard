def compressor(string):
    '''
    Parameter:
        string: a string of digits to be compressed
    Returns:
        A tuple of tuples with each subtuple containing the digitsand their number of occurence
        as integers.
    '''
    assert type(string)==str,'You have not entered a string.'
    try:
        return tuple(sorted({int(i):string.count(i) for i in string}.items()))
    except:
        return 'Invalid input'


#print(compressor('1111222244556'))
