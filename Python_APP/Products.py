import Basic

class Product:

    def __init__(self,i, n, p, st):
        self.id = i
        self.name = n
        self.price = p
        self.stock = st

    def setId(self):
        self.id = Basic.BasicMethods.askstring("Id")

    def getId(self):
        return self.id

    def setName(self):
        self.name = Basic.BasicMethods.askstring("Name")

    def getName(self):
        return self.name

    def setPrice(self):
        self.price = Basic.BasicMethods.askinteger("Price")

    def getPrice(self):
        return self.price

    def setStock(self):
        self.stock = Basic.BasicMethods.askinteger("Stock")

    def getStock(self):
        return self.stock

    def print(self):
      print(self.id, self.name, self.price, self.stock)