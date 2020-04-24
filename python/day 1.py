def guessing_game(no_of_guesses,target):
    """
    This function takes in the desired number of guesses and the target number as parameters.
    It returns the difference between the user's final guess and the target value and attempts to
    guide the user towards the target with each guess.
    """
    assert no_of_guesses>0 and target>=0,'Number of guesses have to be at least 1'
    assert  0<=target<=100, 'target value not in range of 0 to 100'
    for i in range(no_of_guesses):
        print(f'you\'ve made {i} {"guess" if i==1 else "guesses"}')
        guess = int(input('What was my score:\t'))
        assert  0<=guess<=100, 'guessed value not in range of 0 to 100'
        if i!=(no_of_guesses-1):
            if guess<target:
                print('Guess higher')
            elif guess==target:
                return 'Congratations, you have guessed correctly!!'
            else:
                print('Guess lower')
        else:
            if guess == target:
                return f'Congratulations, you have guessed correctly!!'

    return f'Wrong. You were {abs(guess-target)} values away from the answer'
print(guessing_game(5,70))