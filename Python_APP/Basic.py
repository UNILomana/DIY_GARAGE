#Metodo basikoak askotan erabiltzen direlako.
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
    def read_object(obj, filename):
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
        return objects


    @staticmethod
    def delete_object(id, filename):
        inp = open(filename, 'rb')
        objects = []
        cont = 1
        while cont == 1:
            try:
                objects.append(pickle.load(inp))
                objects.pop(id)
            except EOFError:
                print("end of file\n")
                cont = 0
        for objetua in objects:
            print(objetua.id, objetua.name, objetua.surname)




