def to_mandarin(us_num):
    '''
    us_num: an integer representing a US number in the range 0 to 99
    returns: the string mandarin representation of us_num
    '''
    assert type(us_num)==int and 0<us_num<100,'Invalid number'
    n = int(us_num)
    d = {1: 'yi', 2: 'er', 3: 'san', 4: 'si', 5: 'wu', 6: 'liu', 7: 'qi', 8: 'ba', 9: 'jiu', 10: 'shi'}
    a = [n // 10, 10, n % 10]
    if a[0] == 1:
        a.remove(a[0])
    s = ''
    if n in range(11, 100):
        for i in a:
            if i != 0:
                s += (d[i] + ' ')
        return s[0].upper()+s[1:-1]
    return d[n].title()
#print(to_mandarin(77))