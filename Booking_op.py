from Booking import Booking
import datetime
import Basic

def create():
    ans = 1

    while ans == 1:

        b1 = Booking("","","","","","","","","","")

        b1.setId()
        b1.setUser_Id()
        b1.setCabin_Id()
        b1.setDate()
        b1.setHour()
        b1.setVehicle_Type()
        b1.setEmployee_Help()
        b1.setEmployee_Id()
        b1.setUse_Hours()
        b1.setPrice()

        Basic.BasicMethods.save_object(b1, 'Bookings_data.txt')
        print("Booking Added Succesfully")
        ans = int(input("Do you want to add a new Booking? (1/0)= "))
        del b1


def delete():
    ans = 1
    while ans == 1:
        List()
        i = Basic.BasicMethods.askinteger('Id')
        Basic.BasicMethods.delete_booking(int(i), 'Bookings_data.txt')

        print("Booking Deleted Successfully ")
        ans = int(input("Do you want to delete another Booking? (1/0)"))

def List():
    Basic.BasicMethods.read_Booking(Booking, "Bookings_data.txt")

def main_menu():
    from menu import menuGeneral
    menuGeneral()