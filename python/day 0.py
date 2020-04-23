def word_score(word):
    '''
    This function takes in a string as input and
     returns the scrabble score of the word.
    '''
    assert type(word)==str and word.isalpha() , 'You have not entered a valid word'
    points = {"A": 1, "B": 3, "C": 3, "D": 2, "E": 1, "F": 4,
              "G": 2, "H": 4, "I": 1, "J": 8, "K": 5, "L": 1,
              "M": 3, "N": 1, "O": 1, "P": 3, "Q": 10, "R": 1,
              "S": 1, "T": 1, "U": 1, "V": 4, "W": 4, "X": 8,
              "Y": 4, "Z": 10}
    score = 0
    for ch in word.upper():
        score+=points[ch]
    return score
'''words = ['approval',1,'special','development','govern','prioritize','trademark','inventory','penalty','Whimsical']
for word in words:
    print(f'{word} gives you {word_score(word)} points')
'''