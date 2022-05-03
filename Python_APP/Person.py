import Basic

class Person:

    def __init__(self,i, n, s, tlf, e, p):
        self.id = i
        self.name = n
        self.surname = s
        self.phone = tlf
        self.email = e
        self.password = p

    def setId(self):
        self.id = Basic.BasicMethods.askstring("id")

    def getId(self):
        return self.id

    def setName(self):
        self.name = Basic.BasicMethods.askstring("name")

    def getName(self):
        return self.name

    def setSurname(self):
        self.surname = Basic.BasicMethods.askstring("surname")

    def getSurname(self):
        return self.surname

    def setPhone(self):
        self.Phone = Basic.BasicMethods.askinteger("phone")

    def getPhone(self):
        return self.Phone

    def setEmail(self):
        self.email = Basic.BasicMethods.askstring("email")

    def getEmail(self):
        return self.email

    def setPassword(self):
        self.password = Basic.BasicMethods.askstring("password")

    def getPassword(self):
        return self.password

    def print(self):
      print(self.name, self.surname, self.phone, self.email, self.password)