from Users import User
import Basic



def menu():
    print('\tUsers management')
    print('\t================')
    print('\ta) View all users')
    print('\tb) Create a new user')
    print('\tc) Delete an user')
    print('\td) Main menu')

    option = ''

    while option != 'd':
        option = input('Enter an option: ').lower()
        if option == 'a':
            Display_Users()
        if option == 'b':
            Add_User()
        if option == 'c':
            Remove_User()





def Add_User():
    #eginda
    ans = 1
    while ans == 1:

        u1 = User ("", "", "", "", "", "")

        u1.setId()
        u1.setName()
        u1.setSurname()
        u1.setPhone()
        u1.setEmail()
        u1.setPassword()

        Basic.BasicMethods.save_object(u1, 'user_data.txt')
        print("User Added Successfully ")
        ans = int(input("Do you want to add a new user? (1/0)"))
        del u1


def Remove_User():
    #irakurri listan gorde listatik elegidu eta borratu idatzi berriz artxiboan
    ans = 1
    while ans == 1:
        Basic.BasicMethods.delete_object(User,'user_data.txt')

        print("Employee Delete Successfully ")
        ans = int(input("Do you want to delete another student? (1/0)"))


def Display_Users():
    Basic.BasicMethods.read_user(User, 'user_data.txt')

def main_menu():
    from menu import menuGeneral
    menuGeneral()

