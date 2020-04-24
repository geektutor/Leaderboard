def keys_pressed(word):
    '''
    This function takes in word, a string containing text
    and returns a string containing the keys that should be pressed
    to print out the word...
    '''
    assert type(word)==str,'Invalid input...'
    mapper = {
        1:list('.,?!:'),
        2: list('ABC'),
        3: list('DEF'),
        4: list('GHI'),
        5: list('JKL'),
        6: list('MNO'),
        7: list('PQRS'),
        8: list('TUV'),
        9: list('WXYZ'),
        0:[' ']
    }
    pressed = ''
    for i in word:
        no = 0
        key=''
        for k,v in mapper.items():
            if i.upper() in v:
                key=k
                no = v.index(i.upper()) +1
        press = str(key)*no
        pressed+=press
    return pressed

'''print(keys_pressed('Hello World'))'''