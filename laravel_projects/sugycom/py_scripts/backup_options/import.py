import os
import pandas as pd
import tkinter as tk
from tkinter import filedialog
from modulo.mysql_on_db import mysql_extract_table_df, Insertar_registro_masivo, extraer_cabecera


S_base_datos = 'sugycom'
S_tabla = 'crudexamples'

df = mysql_extract_table_df(S_base_datos, S_tabla)
val_index = df.index[-1] + 1
print(df)

file = filedialog.askopenfilename()
dataf = pd.read_csv(file)
new_index_list = list(range(val_index, val_index + len(dataf)))
dataf['id'] = new_index_list
dataf.set_index('id', inplace=True)

print(new_index_list)
print(dataf)

Insertar_registro_masivo(dataf, S_base_datos, S_tabla)
