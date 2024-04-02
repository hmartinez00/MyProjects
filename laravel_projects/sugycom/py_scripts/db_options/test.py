import os
import json
import pandas as pd
import tkinter as tk
from tkinter import filedialog
from modulo.mysql_on_db import mysql_extract_table_df, Insertar_registro_masivo, extraer_cabecera


 # Read the JSON file
with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\db_options.json") as f1:
    rootes = json.load(f1)

S_base_datos = 'sugycom'
S_tabla = rootes['db_table']

print(
    S_base_datos,
    S_tabla,
)

df = mysql_extract_table_df(S_base_datos, S_tabla)
val_index = df.index[-1] + 1
print(df.dtypes)

file = filedialog.askopenfilename()
dataf = pd.read_csv(file)
new_index_list = list(range(val_index, val_index + len(dataf)))
dataf['id'] = new_index_list
dataf.set_index('id', inplace=True)

columnas_datetime = df.select_dtypes(include=['datetime64[ns]']).columns
print(columnas_datetime)
for _ in columnas_datetime:
    dataf[_]   = dataf[_].astype('datetime64[ns]')

# print(new_index_list)
print(dataf.dtypes)

