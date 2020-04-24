def find_edit_dist(str1, str2):
    '''
    The edit distance is the minimum number of insertions, replacements and deletions required to
    transform a string into another.
    Parameters:
        str1 and str2: the strings to be transformed into one another
    Returns:
        The edit distance between them.
    '''
    m,n = len(str1), len(str2)
    # Create a table to store results of subproblems

    dp = [[0 for x in range(n + 1)] for x in range(m + 1)]
    for i in range(m + 1): 
        for j in range(n + 1):
            if i == 0: 

                dp[i][j] = j
            elif j == 0:
                dp[i][j] = i

            elif str1[i-1] == str2[j-1]:
                dp[i][j] = dp[i-1][j-1]
            else: 

                dp[i][j] = 1 + min(dp[i][j-1],        # Insert
                                   dp[i-1][j],        # Remove
                                   dp[i-1][j-1])    # Replace 

    return dp[m][n] 

  


print(find_edit_dist('hide','deih'))
print(find_edit_dist('goat','float'))
print(find_edit_dist('fried','fired'))
print(find_edit_dist('sunday','saturday'))
print(find_edit_dist('goot','got'))
print(find_edit_dist('distant','instant'))
print(find_edit_dist('faithful','faith'))
print(find_edit_dist('engineering','engine'))
print(find_edit_dist('dream','frame'))
print(find_edit_dist('goot','goats'))
