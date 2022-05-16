from Products import Product
import Basic

def menu():

    print('\tProducts management')
    print('\t================')
    print('\ta) View all products')
    print('\tb) Create a new products')
    print('\tc) Delete a product')
    print('\td) Main menu')

    option= ''

    while option != 'd':
        option = input('Enter an option: ').lower()
        if option == 'a':
            Display_Products()
        if option == 'b':
            Add_Product()
        if option == 'c':
            Remove_Product()

def Add_Product():
    #eginda
    ans = 1
    while ans == 1:

        p1 = Product("", "", "", "")
        p1.setId()
        p1.setName()
        p1.setPrice()
        p1.setStock()

        Basic.BasicMethods.save_object(p1, 'products_data.txt')
        print("Product Added Successfully ")
        ans = int(input("Do you want to add a new product? (1/0)"))
        del p1

# Function to Remove Employee with given Id
def Remove_Product():
    #irakurri listan gorde listatik elegidu eta borratu idatzi berriz artxiboan
    ans = 1
    while ans == 1:
        Basic.BasicMethods.delete_product(Product,'products_data.txt')

        print("Product Delete Successfully ")
        ans = int(input("Do you want to delete another Product? (1/0)"))
# Function to Display All Employees

def Display_Products():
    Basic.BasicMethods.read_product(Product, 'products_data.txt')

def main_menu():
    from menu import menuGeneral
    menuGeneral()