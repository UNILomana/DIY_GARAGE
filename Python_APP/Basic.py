#Metodo basikoak askotan erabiltzen direlako.
import os
import pickle
import csv
from csv import reader
from datetime import date

import pandas as pd


class BasicMethods():
    @staticmethod
    def askinteger(znb):
            a=input('Enter a value for ' + znb + ': ')
            return a

    @staticmethod
    def askstring(name):
            a=input('Enter a value for ' + name + ': ')
            return a

    @staticmethod
    def save_object(obj, filename):
        with open(filename, 'ab') as outp:  # Overwrites any existing file.
            pickle.dump(obj, outp, pickle.HIGHEST_PROTOCOL)

    @staticmethod
    def save_object2(obj, filename):
        with open(filename, 'wb') as outp:  # Overwrites any existing file.
            pickle.dump(obj, outp, pickle.HIGHEST_PROTOCOL)

    @staticmethod
    def read_object(obj, filename):
        if os.path.exists(filename):
            inp = open(filename, 'rb')
            objects = []
            cont = 1
            while cont == 1:
                try:
                    objects.append(pickle.load(inp))
                    for objetua in objects:
                        print(objetua.id, objetua.name, objetua.surname)
                except EOFError:
                    print("End of file\n")
                    cont = 0
        else:
            print("There aren´t any clients")


    @staticmethod
    def delete_object(obj, filename):

        if os.path.exists(filename):
            BasicMethods.read_object(obj, filename)
            i = BasicMethods.askinteger('id')
            inp = open(filename, 'rb')
            objects = []
            cont = 1

            while cont == 1:
                try:
                    objects.append(pickle.load(inp))
                except EOFError:
                    print("end of file\n")
                    cont = 0
            #inp.close()
            if os.path.exists(filename):
                os.remove(filename)
            for object in objects:
                if int(object.id) != int(i):
                    BasicMethods.save_object2(object, filename)
        else:
            print("There aren´t any clients")




