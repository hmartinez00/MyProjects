import os
import json
import pandas as pd
from tkinter import filedialog
from General_Utilities.object_utils import get_mark_tags


def av_ag(_agenda: list, _input: str) -> str:
    """
    Esta función calcula el avance de una agenda (_agenda) en un punto específico (_input) 
    y devuelve una cadena con el porcentaje de avance y el elemento actual de la agenda.

    Parámetros:
        _agenda: La lista de elementos de la agenda.
        _input: El elemento actual de la agenda.

    Retorno:
        Una cadena que contiene el porcentaje de avance y el elemento actual de la agenda.
    """
    indice = int(_agenda.index(_input)) + 1
    return f'{(indice)/len(_agenda)*100:.2f}%\t{_input}'

def extract_plan(rootes):
    '''
    ABAE-SAT-UT-SGO
    Desarrollado por: Héctor Martínez (Jefe(E) Telecomunicaciones)
    Creación: 2024-03-01
    Actualización: 2024-03-01
      Script para extraccion de fechas del plan de misiones.
    '''

    key = 'missions'
    directorio = rootes[key]

    # tcplanprepare2(rootes, True)

    rutas = []
    for nombre_directorio, dirs, ficheros in os.walk(directorio):
        for nombre_fichero in ficheros:
            if 'output.csv' in nombre_fichero:
                ruta = nombre_directorio + '\\' + nombre_fichero
                rutas.append(ruta.replace('\\', '/'))

    archivo_0 = rutas[-1]

    return archivo_0

agenda = get_mark_tags()

# main_description: Seleccionando el archivo
print(av_ag(agenda, 'Seleccionando el archivo'))
# file = filedialog.askopenfilename()
with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\rootes.json") as f1:
    rootes = json.load(f1)
file = extract_plan(rootes)
data      = os.path.join(rootes['database'], 'data.xlsx')
directory = os.path.dirname(file)

# main_description: Leyendo los dataframes de partida
print(av_ag(agenda, 'Leyendo los dataframes de partida'))
files = {
    'file1'     : [data, 'missions'],
    'file2'     : [file, 'output'],
}

missions    = pd.read_excel(files['file1'][0], sheet_name=files['file1'][1])
simulation  = pd.read_csv(files['file2'][0])

missions['StartTime'    ]     = missions['StartTime'    ].astype('datetime64[ns]')
missions['StartTime'    ]     = missions['StartTime'    ].astype('datetime64[ns]')
simulation['StartTime'  ]     = simulation['StartTime'  ].astype('datetime64[ns]')
simulation['EndTime'    ]     = simulation['EndTime'    ].astype('datetime64[ns]')
simulation['Duration'   ]     = simulation['Duration'   ].astype('int64')
# simulation.index.name = 'Id'
# columns = list(missions.columns)
# print(simulation.dtypes)
# print(columns)


# main_description: Construyendo el dataframe output
print(av_ag(agenda, 'Construyendo el dataframe output'))
Access_df = [missions, simulation]
Access_final_df = pd.concat(Access_df, axis=0).reset_index().iloc[:,2:-1]
Access_final_df = Access_final_df.sort_values(by='StartTime')
Access_final_df = Access_final_df.drop_duplicates(
    Access_final_df.columns[~Access_final_df.columns.isin(['Id'])],
    keep='first'
)#.reset_index()
Access_final_df = Access_final_df.reset_index(drop=True)
# Access_final_df.reset_index()
Access_final_df.index.name = 'Id'
print(f'len(missions): {len(missions)}', f'len(Access_final_df): {len(Access_final_df)}')

# main_description: Preparando Salida:
print(av_ag(agenda, 'Preparando Salida:'))
nro_rows = -31
print(Access_final_df.iloc[nro_rows:,:])

Access_final_df.to_excel(files['file1'][0], sheet_name=files['file1'][1])
# ask = input('Desea actualizar el archivo? (S/N): ')
# if ask.lower() == 's':
#     Access_final_df.to_excel(files['file1'][0], sheet_name=files['file1'][1])
# else:
#     print('No se ha actualizado el archivo!')
