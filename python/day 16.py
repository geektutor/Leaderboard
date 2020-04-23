def to_binary(b):
    '''
    This function takes in a decimal number as an integer
    and returns its binary representation as a string.
    '''
    if b == 0 or b == 1:
        return str(b)
    else:
        return to_binary(b // 2) + str(b % 2)

def binary_adder(b1,b2):
    '''
    This function takes in two binary numbers as a string
    and returns their sum in binary as a string.
    '''
    to_decimal = lambda d: sum(int(d[i]) << (len(d) - 1 - i) for i in range(len(d)))

    return to_binary(to_decimal(b1)+to_decimal(b2))
print(binary_adder('11','11'))


