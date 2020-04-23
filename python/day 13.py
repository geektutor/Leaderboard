def wrapper(para,char):
    f'''
    This function takes in :
    para: a paragraph of text as a string and
    char: an integer representing the maximum number of characters per line
    Returns:
        A new string with at most 'char' characters per line.
    '''
    assert type(para)==str,'You have not entered a valid paragraph'
    assert type(char)==int and char>0,'Invalid number of characters per line'
    lines = para.split('\n')
    new =''
    for line in lines:
        while len(line)>char:
            new+= line[:10]+'\n'
            line = line[10:]
        new+=line+'\n'
    return new[:-1]

#print(wrapper('We went too soon\nAnd came back too early...',10))