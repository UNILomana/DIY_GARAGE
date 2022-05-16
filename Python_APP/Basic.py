#Metodo basikoak askotan erabiltzen direlako.
import os.path
import pickle
import csv
from csv import reader
from datetime import date



class BasicMethods():
    @staticmethod
    def askinteger(znb):
            a=input('Enter a value for ' + znb + ': ')
            return a

    @staticmethod
    def askstring(name):
            a=input('Enter a value for ' + name + ': ')
            return a

    #te añade a la lista el nuevo objeto
    @staticmethod
    def save_object(obj, filename):
        with open(filename, 'ab') as outp:  # Overwrites any existing file.
            pickle.dump(obj, outp, pickle.HIGHEST_PROTOCOL)

    #te elimina la lista y crea una nueva sin el objeto eliminado
    @staticmethod
    def save_object2(obj, filename):
        with open(filename, 'wb') as outp:  # Overwrites any existing file.
            pickle.dump(obj, outp, pickle.HIGHEST_PROTOCOL)

    @staticmethod
    def read_object(obj, filename):
        inp = open(filename, 'rb')
        objects = []
        cont = 1
        while cont == 1:
            try:
                objects.append(pickle.load(inp))

            except EOFError:

                cont = 0
        for objetua in objects:
            print(objetua.id, objetua.name, objetua.surname)

        print("End of file\n")
        return objects

    def read_product(obj, filename):
        inp = open(filename, 'rb')
        objects = []
        cont = 1
        while cont == 1:
            try:
                objects.append(pickle.load(inp))

            except EOFError:

                cont = 0
        for product in objects:
            print(product.id, product.name, product.price, product.stock)

        print("End of file\n")
        return objects

    @staticmethod
    def read_user(obj, filename):
        if os.path.exists(filename):
            inp = open(filename, 'rb')
            objects = []
            cont = 1
            while cont == 1:
                try:
                    objects.append(pickle.load(inp))

                except EOFError:

                    cont = 0
            for objetua in objects:
                print(objetua.id, objetua.name, objetua.surname, objetua.phone, objetua.email, objetua.password)

            print("End of file\n")
        else:
            print("There aren't any users")


    @staticmethod
    def delete_object(obj,filename):
        if os.path.exists(filename):
            BasicMethods.read_user(obj,filename)
            id = input("Enter the id of the person: ")
            inp = open('user_data.txt','rb')
            objects = []
            cont = 1
            while cont == 1:
                try:
                    objects.append(pickle.load(inp))
                except EOFError:

                    cont = 0
            inp.close()
            if os.path.exists(filename):
                os.remove(filename)
            for objetua in objects:
                if int(objetua.id) != int(id):
                   BasicMethods.save_object2(objetua,filename)
            print("end of file\n")
        else:
            print("There aren't any Clients")




