def gpa_calculator(scores,units):
    '''
    Parameters:
    -------------------------------------------------------------------
    This function takes in:
        scores :A list of scores of the student in various courses
        units: A list of the the weights assigned to the various courses
               in the same order as the scores list
    
    Returns:
    -----------------------------------------------------------------------
    A 2 decimal placed float which is the grade point average of the student
    based on those grades
    '''
    assert type(scores) is list and type(units) is list,'You have not entered either or both your scores and units as a list'
    assert len(scores)==len(units),'Number of scores and units do not correspond'
    grades = {5:range(70,101),
             4:range(60,70),
             3:range(50,60),
             2:range(45,50),
             1:range(40,45),
             0:range(0,40)}
    points = 0
    for i in range(len(scores)):
        for k,v in grades.items():
            assert type(scores[i]) is int and 0<=scores[i]<=100,f'{scores[i]} is an invalid input'
            if scores[i] in v:
                assert type(units[i]) is int and 1<=units[i]<=6,f'{units[i]} is an invalid input'
                points+= k*units[i]
    return round((points/sum(units)),2)
'''
#Test_cases:
print(gpa_calculator([30,40,50,60,70,80],[3,3,3,3,3,3]))
#print(gpa_calculator([30,40,50,60,70,80],[2,4,3,1]))
print(gpa_calculator([60,101,60,60,60],[2,4,3,1,5]))
print(gpa_calculator([60,-1,60,60,60],[3,3,3,3,3]))
print(gpa_calculator([60,'a',60,60,60],[3,3,3,3,3]))
print(gpa_calculator([60,60,60,60,60],[3,3,'b',3,3]))
print(gpa_calculator('60,60,60,60,60','3,3,3,3,3'))'''