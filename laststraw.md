# Design

# Mobile

Corona Virus Tracking App

# Web

Implement [this](https://www.figma.com/file/GDla3bQomRCqtohrLiNjOI/Isaac's-Day-24-DSC-30-days-of-Code-(UI%2FUX)?node-id=14%3A4).

Priority is given to the landing page + sign up page, login page and task page

# Python

Given a string of digits S, create a function named nester that inserts a minimum number of opening and closing parentheses into it such that the resulting string is balanced and each digit d is inside exactly d pairs of matching parentheses.

Let the nesting of two parentheses within a string be the substring that occurs strictly between them. An opening parenthesis and a closing parenthesis that is further to its right are said to match if their nesting is empty, or if every parenthesis in their nesting matches with another parenthesis in their nesting. The nesting depth of a position p is the number of pairs of matching parentheses m such that p is included in the nesting of m.

For example, in the following strings, all digits match their nesting depth: 0((2)1), (((3))1(2)), ((((4)))), ((2))((2))(1). The first three strings have minimum length among those that have the same digits in the same order, but the last one does not since ((22)1) also has the digits 221 and is shorter.

Given a string of digits s, find another string S, comprised of parentheses and digits, such that:

• all parentheses in S match some other parenthesis,
• removing any and all parentheses from S results in s,
• each digit in S is equal to its nesting depth, and
• S is of minimum length.

Test cases:
print(nester('0000')) #Output: 0000
print(nester('302')) #Output: (((3)))0((2))
print(nester('111000')) #Output: (111)000
print(nester('4215')) #Output: ((((4))2)1((((5)))))


# Backend
