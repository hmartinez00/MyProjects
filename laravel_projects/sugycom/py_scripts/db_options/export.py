import os
import json
import tkinter as tk
from tkinter import filedialog
from datetime import datetime as dt
from modulo.mysql_on_db import mysql_extract_table_df

fecha = '_' + str(dt.now()).replace(' ', '-').replace(':', '').replace('.', '-')

 # Read the JSON file
with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\db_options.json") as f1:
    rootes = json.load(f1)

S_base_datos = 'sugycom'
S_tabla = rootes['db_table']

df = mysql_extract_table_df(S_base_datos, S_tabla)

root = tk.Tk()
root.withdraw()
directory = filedialog.askdirectory()

file = os.path.join(directory, S_tabla + fecha + '.csv')

df.to_csv(file)
