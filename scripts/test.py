import pandas as pd
import numpy as np
from ManageDB.sqlite_on_db import selectall
from ManageDB.mysql_on_db import Insertar_registro_masivo


def extraer_cabeceras(__base_datos__, __tabla__):
    import mysql.connector
    # Establecer la conexión a la base de datos
    conexion = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database=__base_datos__
    )
    # Crear un cursor para ejecutar consultas
    cursor = conexion.cursor()
    # Definir el nombre de la tabla
    nombre_tabla = __tabla__
    # Consulta para obtener las cabeceras de la tabla
    consulta = f"SHOW COLUMNS FROM {nombre_tabla}"
    # Ejecutar la consulta
    cursor.execute(consulta)
    # Obtener los resultados
    resultados = cursor.fetchall()
    # Imprimir las cabeceras
    fields = []
    for resultado in resultados:
        fields.append(resultado[0])
    # Cerrar el cursor y la conexión a la base de datos
    cursor.close()
    conexion.close()

    return fields

# Bases de datos de partida y llegada
    # Start
db = r'C:\Users\admin\Documents\0 - A Repositorios GitHub\Devocionales\2tim4_1.db'
table = 'plan_biblia_52'
    # End
base_datos = 'devocionales'
tabla = table + 's'


# Extraemos los datos de la tabla de partida
df = selectall(db, table)


# Concatenamos las columnas copmplementarias
for i in range(2):
    tag_col = f'column{i}'
    df[tag_col] = pd.to_datetime(['' for _ in range(len(df))], format='%m/%d/%Y')
    df[tag_col] = df[tag_col].dt.strftime('%Y-%m-%d')


# Extraemos las columnas de la tabla de llegada
cabeceras = extraer_cabeceras(base_datos, tabla)
df.columns = cabeceras
df = df.set_index('id')

print(cabeceras)
print(df)

# Insertar en Database
Insertar_registro_masivo(df, base_datos, tabla)


