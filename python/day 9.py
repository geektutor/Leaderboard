def decryptor(string,S):
    '''
    Parameters:
        string: The encoded string
        S: an integer represent the decryption key
    Returns:
        The decrypted text.
    '''
    assert type(string)==str,'You have not entered a string'
    assert type(S)==int and -26<S<26,'You have not entered a valid decryptor.'
    al = list('abcdefghijklmnopqrstuvwxyz')
    au = list('ABCDEFGHIJKLMNOPQRSTUVWXYZ')
    decoded = ''
    for i in string:
        if i.isalpha():
            if i.isupper():
                if au.index(i)+S >= 26:
                    decoded+=au[au.index(i)+S - 26]
                else: decoded+=au[au.index(i)+S]
            else:
                if al.index(i)+S >= 26:
                    decoded+=al[al.index(i)+S - 26]
                else: decoded += al[al.index(i) + S]
        else:
            decoded+=i
    return decoded
#print(decryptor('Wkh erb lv jrrg.',-3))