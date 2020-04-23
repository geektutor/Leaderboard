def power_list(List):
    """
    This function takes a list as parameter and returns its power list
    (a list containing all the sub lists of a particular super list including null
    list and list itself).
     """
    if List==[]:
        return [[]]
    a=List[0]
    b=power_list(List[1:])
    c=[]
    for d in b:
        c.append([a]+ d)
    return sorted(c+b,key=len)

'''

#test cases
x = power_list([2,4,6,8])
print(x)
print(power_list([9,100]))

'''