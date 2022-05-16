import datetime
import Basic

class Booking:
    def __init__(self, i, u, c, d, h, vt, emph, empi, uh, p):

        self.Id = i
        self.User_Id = u
        self.Cabin_Id = c
        self.Date = d
        self.Hour = h
        self.Vehicle_Type = vt
        self.Employee_Help = emph
        self.Employee_Id = empi
        self.Use_Hours = uh
        self.Price = p

    def setId(self):
        self.Id = Basic.BasicMethods.askinteger("Id")

    def getId(self):
         return self.Id

    def setUser_Id(self):
        self.User_Id = Basic.BasicMethods.askinteger("User_Id")

    def getUser_Id(self):
        return self.User_Id

    def setCabin_Id(self):
        self.Cabin_Id = Basic.BasicMethods.askinteger("Cabin_Id")

    def getCabin_Id(self):
        return self.Cabin_Id

    def setDate(self):
        self.Date = Basic.BasicMethods.askinteger("Date")

    def getDate(self):
        return self.Date

    def setHour(self):
        self.Hour = Basic.BasicMethods.askinteger("Hour")

    def getHour(self):
        return self.Hour

    def setVehicle_Type(self):
        self.Vehicle_Type = Basic.BasicMethods.askstring("Vehicle_Type")

    def getVehicle_Type(self):
        return self.Vehicle_Type

    def setEmployee_Help(self):
        self.Employee_Help = Basic.BasicMethods.askstring("Employee_Help")

    def getEmployee_Help(self):
        return self.Employee_Help

    def setEmployee_Id(self):
        self.Employee_Id = Basic.BasicMethods.askinteger("Employee_Id")

    def getEmployee_Id(self):
        return self.Employee_Id

    def setUse_Hours(self):
        self.Use_Hours = Basic.BasicMethods.askinteger("Use_Hours")

    def getUse_Hours(self):
        return self.Use_Hours

    def setPrice(self):
        self.Price = Basic.BasicMethods.askinteger("Price")

    def getPrice(self):
        return self.Price

    def print(self):
        print(self.Id, self.User_Id, self.Cabin_Id, self.Date, self.Hour, self.Vehicle_Type,'Yes' if self.Employee_Help else 'No', self.Employee_Id, self.Use_Hours, self.Price)

