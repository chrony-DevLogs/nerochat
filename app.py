a = "abdeNnour"

def toUpper(a):
    b = ""
    for i in range(len(a)):
        if(ord(a[i]) >= 97):
            makeItUpper = ord(a[i]) - 32
            b += chr(makeItUpper)
        else:
            b += a[i]
    return b


a[0] = "5"
print(a)