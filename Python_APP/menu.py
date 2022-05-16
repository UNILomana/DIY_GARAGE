from employers_menu import menu as menuEmployers
from users_menu import menu as menuUsers
from products_menu import menu as menuProducts


def menuMimprimatu():
    print('MENU')
    print('================')
    print('a) Employers Management')
    print('b) Products Management')
    print('c) Bookings Management')
    print('d) Users Management')
    print('e) Exit')

    option = ''
    print("================")
def menuGeneral():

    menuMimprimatu()
    option = input('Enter an option: ').lower()
    while option != 'e':
        if option == 'a':
            menuEmployers()
        if option == 'b':
            menuProducts()
        if option == 'c':
            menuBookings()
        if option == 'd':
            menuUsers()
        menuMimprimatu()
        option = input('Main menu Enter an option: ').lower()

menuGeneral()