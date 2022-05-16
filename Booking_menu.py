import Booking_op

def menu():
    print("Bookings")
    print("=============")
    print("a) Create a Booking")
    print("b) Delete a Booking")
    print("c) List of the Booking")
    print("d) Main Menu")
    option = ''

    while option != 'e':
        option = input("Enter an option: ").lower()
        if option == 'a':
            Booking_op.create()
        if option == 'b':
            Booking_op.delete()
        if option == 'c':
            Booking_op.List()
        if option =='d':
            Booking_op.main_menu()
