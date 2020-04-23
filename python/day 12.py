def validating_email(mail):
    '''
    Parameter:
        mail: a string containing the mail to be validated.
    Returns:
        A string stating whether the mail is valid.
    '''
    assert mail.count('@')==1 and type(mail)==str,False
    someone, domain = tuple(mail.split('@'))
    domains = domain.split('.')
    alphachar = 'abcdefghijklmnopqrstuvwxyz0123456789'+'!"#$%&\'()*+,-./:;<=>?[\\]^_`{|}~'
    proof0 = [someone.count('.')==1 if '.' in someone else True]
    proof1= [False for i in someone if i not in alphachar]
    proof2 = [False for i in domains[0] if i not in alphachar[:36]+'_']
    proof3 = [len(domains[-1]) in [2,3] and '' not in mail.split('.')]
    proof4 = [False for i in ''.join(domains) if i not in alphachar[:26]]
    proof = proof0+proof1+proof2+proof3+proof4
    return 'Invalid mail' if False in proof else 'Valid mail'

print(validating_email('fortadeks31@yahoo.co.uk'))
print(validating_email('fortAdeks@gmail.com'))
print(validating_email('fortade..ks31@yahoo.com'))
print(validating_email('Fortadeks31@yahoo.co.uk'))
print(validating_email('fortadeks31yahoo.co.uk'))











