from Employees import Employee
import Basic


def menu_E():
    print('\tEmployee management')
    print('\t=========================')
    print('\ta) View all employers')
    print('\tb) Create a new employee')
    print('\tc) Delete an employee')
    print('\td) Main menu')

    print('\t=========================')
    option =''

    while option != 'd':
        option = input('\tEnter an option: ').lower()
        if option == 'a':
            Display_Employees()
        if option == 'b':
            Add_Employ()
        if option == 'c':
            Remove_Employ()


def Add_Employ():
    ans = 1
    while ans == 1:
        e1 = Employee('', '', '', '', '', '', '')

        e1.setId()
        e1.setName()
        e1.setSurname()
        e1.setPhone()
        e1.setAddress()
        e1.setEmail()
        e1.setPassword()

        Basic.BasicMethods.save_object_append(e1, 'employee_data.pkl')
        print("Employee Added Successfully ")
        ans = int(input("Do you want to add a new student? (1/0)"))
        del e1


# Function to Remove Employee with given id
def Remove_Employ():
    ans = 1
    while ans == 1:
        Basic.BasicMethods.delete_object(Employee, 'employee_data.pkl')
        print("Employee Delete Successfully ")
        ans = int(input("Do you want to delete another student? (1/0)"))


# Function to Display All Employees
def Display_Employees():
    Basic.BasicMethods.read_object(Employee, 'employee_data.pkl')


# Functon to go main_menu
def main_menu():
    from menu import menuGeneral
    menuGeneral()


