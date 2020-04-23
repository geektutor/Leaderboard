def desc_triangle(a,b,c):
    '''
    This function takes in 3 integers a,b,c representing the length of the sides
    of a triangle and Returns a tuple of 2 elements whose first element is a
    string describing the triangle and second element is the area of the
    triangle...
    '''
    s= (a+b+c)/2
    area = ((s-a)*(s-b)*(s-c))**0.5
    scalene = a!=b and b!=c and a!=c
    equilateral = a==b==c
    isosceles = len({a,b,c})==2
    right = a**2 == b**2 + c**2 or a**2 == abs(b**2 - c**2)
    if scalene: desc='Scalene Triangle'
    elif equilateral: desc='Equilateral Triangle'
    elif isosceles: desc = 'Isosceles Triangle'
    if right: desc=desc[:-8]+'and Right Triangle'
    return desc,round(area,2)


'''print(desc_triangle(3,4,5))'''
