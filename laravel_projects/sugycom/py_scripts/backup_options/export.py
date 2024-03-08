import os
import tkinter as tk
from tkinter import filedialog
from modulo.mysql_on_db import mysql_extract_table_df


base_datos = 'sugycom'
tabla = 'crudexamples'

df = mysql_extract_table_df(base_datos, tabla)

root = tk.Tk()
root.withdraw()
directory = filedialog.askdirectory()

file = os.path.join(directory, 'output.csv')

df.to_csv(file)
