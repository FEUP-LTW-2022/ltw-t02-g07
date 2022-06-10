import sqlite3
import os.path
from os import path

# to create fresh db, run through terminal or command line in python,
# for example windows python create_database.py

if path.exists("dblite.db"): #deletes db if exists
    os.remove("dblite.db")


#create db file and applies scheme
connection = sqlite3.connect("dblite.db")
cursor = connection.cursor()
sql_file = open("dblite.sql")
sql_as_string = sql_file.read()
cursor.executescript(sql_as_string)
connection.commit()
connection.close()


