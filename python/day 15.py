def ultimate_reverser(filename):
    '''
    This function reverses the characters on each line and the lines in a file.

    Parameter:
        filename: the name of the text file to be reversed.
    Return:
        The reversed file
    '''
    f= open(filename)
    lines = f.readlines()
    f.close()
    print(lines)
    reversed = ''.join([i[::-1] for i in lines][::-1])
    w = open('disordered.txt','w')

    return w.write(reversed)

ultimate_reverser('reversed_story.txt')