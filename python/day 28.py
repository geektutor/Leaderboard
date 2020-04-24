def magic_dates(date):
    '''
    This function takes in a date as a string in the form 'Month day,Year' and
    returns a boolean indicating whether it is a magic date or not.
    '''
    assert ' ' in date and ',' in date,'Invalid date'
    month,rest = tuple(date.split(' '))
    day,year = tuple(rest.split(','))
    assert year.isnumeric() and int(year)>0,'Invalid year entered.'
    assert day.isnumeric() and 0<int(day)<32,'Invalid day entered'
    months = {
        'January' : 1,
        'February':2,
        'March':3,
        'April':4,
        'May':5,
        'June':6,
        'July':7,
        'August':8,
        'September':9,
        'October':10,
        'November':11,
        'December':12

    }
    assert month.title() in months.keys(),'Invalid month entered'
    day = int(day)
    month = months[month.title()]
    year = int(year[-2:])
    return day*month ==year


#print(magic_dates('June 11,1966'))

def count_magic(year):
    '''
    This function takes in an integer representing a year and returns
    a list of all magic dates in that year.
    '''
    assert type(year)==int and year > 0, 'Invalid year entered.'
    yy = int(str(year)[-2:])
    magic_code = ()
    leap = True if int(year)%4==0 and int(year) not in [1800,1900,2100,2200,2300] else False
    for i in range(1,13):
        for j in range(1,32):
            if i==2 and leap and j>29:
                break
            elif i==2 and not leap and j>28:
                break
            elif i in [4,9,11] and j>30:
                break
            if i*j==yy:
                magic_code+=((i,j),)
    dates = []
    to_month={1: 'January',
     2: 'February',
     3: 'March',
     4: 'April',
     5: 'May',
     6: 'June',
     7: 'July',
     8: 'August',
     9: 'September',
     10: 'October',
     11: 'November',
     12: 'December'}
    for code in magic_code:
        d = f'{to_month[code[0]]} {code[1]},{year}'
        dates.append(d)
    return dates

#print(count_magic(1000))