def Hangman(word,N):
    assert type(word)==str and word.isalpha(),'You have not entered a word.'
    assert type(N)== int,'You have not entered a valid number of guessses'
    assert N>=len(word),'Be fair, too little alloted guesses'
    word = word.lower()
    char = {i:word.count(i) for i in word}
    print(f'You have {N} guess(es)...')
    while N>0:
        guess = input('Guess a letter:')
        if not guess.isalpha():
            N-=1
            print(f'Invalid guess, {N if N>0 else 0} more guess(es)')
            continue
        if guess.lower() in word:
            print(guess)
            char[guess] -= 1
        elif sum(char.values())==0:
            return f'You have correctly guessed the word {word.title()}'
        else:
            print('_')
        N-=1
        if N>1: print(f'You have {N} guess(es) left')
    if sum(char.values())==0:
        return f'You have correctly guessed the word {word.title()}'
    return 'You have failed this city!'
#print(Hangman('Enjoy',6))
#print(Hangman('Decapitate',12))
#print(Hangman(123,3))
#print(Hangman('End12',6))
#print(Hangman('Fortune','r'))
#print(Hangman('Discombabulated',12))


