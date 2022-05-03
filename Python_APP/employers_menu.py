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
        #i = Employee.setId()
        #sn = Employee.setName('name')
        #ss = Employee.setSurname('surname')
        #stlf = Employee.setPhone('tlf')
        #sa = Employee.setAddress('address')
        #se = Employee.setEmail('email')
        #sp = Employee.setPassword('password')

        i = Basic.BasicMethods.askstring('id')
        sn = Basic.BasicMethods.askstring('name')
        ss = Basic.BasicMethods.askstring('surname')
        stlf = Basic.BasicMethods.askstring('tlf')
        sa = Basic.BasicMethods.askstring('address')
        se = Basic.BasicMethods.askstring('email')
        sp = Basic.BasicMethods.askstring('password')

        e1 = Employee(i, sn, ss, stlf, sa, se, sp)

        Basic.BasicMethods.save_object(e1, 'employee_data.pkl')
        print("Employee Added Successfully ")
        ans = int(input("Do you want to add a new student? (1/0)"))
        del e1


# Function to Remove Employee with given Id
def Remove_Employ():
    #irakurri listan gorde listatik elegidu eta borratu idatzi berriz artxiboan
    ans = 1
    while ans == 1:
        Basic.BasicMethods.delete_object(Employee, 'employee_data.pkl')
        print("Employee Delete Successfully ")
        ans = int(input("Do you want to delete another student? (1/0)"))


# Function to Display All Employees
def Display_Employees():
    Basic.BasicMethods.read_object(Employee, 'employee_data.pkl')

menu()