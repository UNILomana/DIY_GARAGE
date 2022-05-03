import employers_menu
print('MENU')
print('================')
print('a) Employees Management')
print('b) Products Management')
print('c) Bookings Management')
print('d) Users Management')
print('e) Exit')

option = input('Enter an option: ').lower()

while option != 'e':
    if option == 'a':
        employers_menu()
    if option == 'b':
        products_menu()
    if option == 'c':
        bookings_menu()
    if option == 'd':
        users_menu()

    option = input('Enter an option: ').lower()

