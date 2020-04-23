def anagram_finder(l):
    '''
    Parameter:
        l: a list of words
    Return:
        A list of lists where each sublist contains words in the original lists that are anagrams.
    '''
    assert type(l)==list,'You have either not entered a list'
    assert ''.join(l).isalpha(),'Not all words are alphabetic'
    mapper= {i:''.join(sorted(i)) for i in l}
    val = set(mapper.values())
    return [[k for k,v in mapper.items() if v==i] for i in val]


'''print(anagram_finder(['fired','fried','good','dog']))
'''