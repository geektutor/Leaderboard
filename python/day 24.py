def pressure_converter(newton, convert_to):
    """
    A function that converts pressure in newton to other si units
    :param newton: The pressure in newton
    :param convert_to: The si unit to convert to
    :return: returns converted pressure 
    """
    if convert_to == 'pa':
        return newton
    if convert_to == 'atm':
        return newton / 101325
    if convert_to == 'mmhg':
        return newton / 133
    if convert_to == 'bar':
        return newton / 100000


def temp_converter(kelvin, convert_to):
    """
    A function that converts temperature in kelvin to other si units
    :param kelvin: The temperature in kelvin
    :param convert_to: The si unit to convert too
    :return: returns converted temperature 
    """
    if convert_to == '°c':
        return kelvin - 273.15
    if convert_to == '°f':
        return ((kelvin - 273.15) * (9/5)) + 32
    if convert_to == '°r':
        return kelvin * 1.8



def intensive_properties(quantities,convert_to):
    """
    A function that converts pressure in newton and temperature in kelvin 
    to other si unit
    :param quantities: pressure and temperature in a tuple
    :1 convert_to: si units to convert to in a tuple
    :return: converted pressure and temperature in a tuple
    """
    pressure = ['pa','atm','mmhg','bar']  # Valid output pressure units
    temperature = ['°c','°f','°r']  # Valid output temperature units
    assert type(quantities) == tuple and type(convert_to) == tuple,'You have not entered parameters as tuples.'
    assert convert_to[0].lower() in pressure and convert_to[1].lower() in temperature,'You have not entered valud units.'
    if quantities[0] >= 0:
        return (pressure_converter(quantities[0],convert_to[0].lower()),
                        temp_converter(quantities[1],convert_to[1].lower()))
    else:
        return 'invalid input, pressure cant be negative'


'''print(intensive_properties((101325,298),('mmHg','°F')))
print(intensive_properties((101325,0),('atm','°F')))
print(intensive_properties((-101325,20),('atm','°C')))
print(intensive_properties((760,0),('Atm','°c')))
#print(intensive_properties([101325,0],('atm','°F')))
#print(intensive_properties((101325,0),['atm','°F']))
print(intensive_properties((101325,-20),('atm','°C')))'''