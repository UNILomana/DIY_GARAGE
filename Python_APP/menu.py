from employers_menu import menu_E as menu_Emp
from users_menu import menuU as menu_Use

def menuGeneral():
    print('MENU')
    print('=========================')
    print('a) Employees Management')
    print('b) Products Management')
    print('c) Bookings Management')
    print('d) Users Management')
    print('e) Exit')

    option=''
    print('=========================')

    while option != 'e':
        option = input('Main menu options: ').lower()
        if option == 'a':
            menu_Emp()
        if option == 'b':
            menu_Use()
        if option == 'c':
            bookings_menu()
        if option == 'd':
            users_menu.menu()

menuGeneral()