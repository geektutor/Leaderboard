def sieve_of_eratos(limit):
    '''
    Parameter:
        L: a list
    Returns:
        A list of prime numbers that are in the
    '''

    L = list((range(2 , limit)))
    for i in range(int(len(L)**0.5 + 1)):
        for j in range(len(L)):
            if L[i] != 0 and L[j] != 0:
                if L[j] % L[i] == 0 and L[j] != L[i]:
                    L[j] = 0
    return [i for i in L if i != 0]

#print(sieve_of_eratos(1000))

