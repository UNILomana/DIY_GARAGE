import Basic
from Person import Person

#https://www.geeksforgeeks.org/employee-management-system-using-python/

class Employee(Person):
    def __init__(self, i, sn, ss, stlf, a, se, sp):
        super().__init__(i, sn, ss, stlf, se, sp)
        self.address = a

    def setAddress(self):
        self.address = Basic.BasicMethods.askstring("address")

    def getAddress(self):
        return self.address

    def print(self):
        print(self.id, self.name, self.surname, self.phone, self.address, self.email, self.password)

