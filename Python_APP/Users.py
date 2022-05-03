import Basic
from Person import Person

class User(Person):

    def __init__(self, i, sn, ss, stlf, se, sp):
        super().__init__(i, sn, ss, stlf, se, sp)

    def print(self):
        print(self.id, self.name, self.surname, self.phone, self.email, self.password)