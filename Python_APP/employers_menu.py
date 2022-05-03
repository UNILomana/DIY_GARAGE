from Employees import Employee
import Basic


def menu():
    print('Employee management')
    print('================')
    print('a) View all employers')
    print('b) Create a new employee')
    print('c) Delete an employee')
    print('d) Main menu')
    option = input('Enter an option: ').lower()

    while option != 'e':
        if option == 'a':
            Display_Employees()
        if option == 'b':
            Add_Employ()
        if option == 'c':
            Remove_Employ()
        if option == 'd':
            main_menu()

        option = input('Enter an option: ').lower()

def Add_Employ():
    #eginda
    ans = 1
    while ans == 1:

        i = Basic.BasicMethods.askinteger('id')
        sn = Basic.BasicMethods.askstring('name')
        ss = Basic.BasicMethods.askstring('surname')
        stlf = Basic.BasicMethods.askinteger('tlf')
        sa = Basic.BasicMethods.askstring('address')
        se = Basic.BasicMethods.askstring('email')
        sp = Basic.BasicMethods.askstring('password')
        e1 = Employee(i, sn, ss, stlf, sa, se, sp)

        Basic.BasicMethods.save_object(e1, 'employee_data.txt')
        print("Employee Added Successfully ")
        ans = int(input("Do you want to add a new student? (1/0)"))
        del e1


# Function to Remove Employee with given Id
def Remove_Employ():
    #irakurri listan gorde listatik elegidu eta borratu idatzi berriz artxiboan
    ans = 1
    while ans == 1:
        Display_Employees()
        i = Basic.BasicMethods.askinteger('id')
        Basic.BasicMethods.delete_object(int(i), 'employee_data.txt')

        print("Employee Delete Successfully ")
        ans = int(input("Do you want to delete another student? (1/0)"))


# Function to Display All Employees
def Display_Employees():
    Basic.BasicMethods.read_object(Employee, 'employee_data.txt')

menu()