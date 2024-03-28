import os
import json
import unidecode
import numpy as np
import pandas as pd
from tkinter import filedialog
from datetime import datetime, timedelta
from modulos.General_Utilities.fecha import BatchID
from modulos.V2Gen.cplanmodule2 import BatchID_missions_table
from modulos.General_Utilities.object_utils import get_mark_tags


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

def extract_list(_input_s: str, _input_list: list) -> list:
    """
    Esta función extrae de una lista (_input_list) todos los elementos que contienen la cadena de caracteres (_input_s) y los devuelve en una lista junto con sus índices originales en la lista original.

    Args:
        _input_s: La cadena de caracteres a buscar.
        _input_list: La lista de elementos de la que se extraerán los elementos que contienen la cadena de caracteres.

    Returns:
        Una lista que contiene dos listas: la primera lista contiene los elementos extraídos y la segunda lista contiene los índices originales de los elementos extraídos en la lista original.
    """
    output_list = []
    perm_index = []
    for i in range(len(_input_list)):
        if _input_s in _input_list[i]:
            element = str(_input_list[i]).replace(' ', '').lower()
            output_list.append(element)
            perm_index.append(i)
    
    return [output_list, perm_index]

def permutar_pares(df: pd.DataFrame, list_index: list) -> pd.DataFrame:
    """
    Permuta pares de renglones en un dataframe.

    Args:
        df: El dataframe a permutar.

    Returns:
        Un dataframe con los pares de renglones permutados.
    """
    # print(list_index)
    top = len(df)
    for i in range(top):
        condition = (i in list_index)
        if (i+1<top) & condition:
            df.iloc[i], df.iloc[i + 1] = df.iloc[i + 1], df.iloc[i]
    return df

def contejar_cadenas(
        _list1: list,
        _list2: list,
        _list3: list = None,
    ) -> list:
    """
    Esta función compara tres listas de cadenas (_list1, _list2 y _list3 opcional) e identifica las cadenas de la segunda lista (_list2) que están contenidas dentro de las cadenas de la primera lista (_list1). Si se proporciona una tercera lista (_list3), la función utiliza las cadenas de esta lista para etiquetar las coincidencias encontradas.

    Args:
        _list1: La primera lista de cadenas.
        _list2: La segunda lista de cadenas.
        _list3: La tercera lista de cadenas (opcional). Se utiliza para etiquetar las coincidencias encontradas. Si no se proporciona, se utilizan las cadenas de la segunda lista para el etiquetado.

    Returns:
        Una lista del mismo tamaño que la primera lista (_list1). Cada elemento de la lista de salida contiene una cadena separada por comas que enumera las etiquetas correspondientes a las cadenas de la segunda lista que se encontraron en la cadena correspondiente de la primera lista. Si no se encontraron coincidencias para una cadena específica en la primera lista, el elemento de salida será `np.nan`.
    """
    top1 = len(_list1)
    top2 = len(_list2)
    _output_list = [np.nan for _ in range(top1)]

    for i in range(top1):
        label_list = []
        for j in range(top2):
            reference   = unidecode.unidecode(str(_list2[j])).lower()
            input_label = unidecode.unidecode(str(_list3[j])).lower()
            label       = str(_list1[i]).lower()
            condition   = reference in label

            if condition:
                label_list.append(input_label.title())
        
        if len(label_list) > 0:
            _output_list[i] = ', '.join(set(label_list))
    
    return _output_list

def obtener_fecha_lunes(fecha: datetime):
    """
    Esta función devuelve la fecha del lunes de la semana que contiene la fecha proporcionada.

    Esta función es útil para obtener la fecha del lunes de una semana a partir de cualquier fecha dentro de esa semana.

    Parámetros:
        fecha: La fecha de la que se desea obtener el lunes.

    Retorno:
        La fecha del lunes de la semana que contiene la fecha proporcionada.
    """
    dia_semana = fecha.weekday()
    lunes = fecha - timedelta(days=dia_semana)
    return lunes

def assing_solutionid(df: pd.DataFrame) -> pd.DataFrame:
    """
    Esta función asigna un identificador de solución (`SolutionID`) a cada fila en un DataFrame.

    Parámetros:
        df (pd.DataFrame): El DataFrame de entrada que contiene las columnas 'StartTime' y 'BatchID'. Se espera que estas columnas contengan valores de fecha y hora y valores enteros, respectivamente.

    Retorno:
        pd.DataFrame: Un nuevo DataFrame con las siguientes columnas añadidas:
            - 'Sol_id': Identificador de la solución (resultado de la combinación de la fecha del lunes correspondiente a la fecha mínima de 'StartTime', un número entero secuencial y un identificador único por combinación de 'taskName' minimizado y 'BatchID').
            - 'StartTime': Fecha y hora de inicio de la tarea.
            - 'taskName_minimal': Nombre de la tarea minimizado (sin espacios y en minúsculas).
            - 'taskName': Nombre original de la tarea (tal como aparece en la columna 'taskName' del DataFrame original).

    Pasos principales:

    1. **Obtener la fecha del lunes de la semana de la fecha mínima de 'StartTime':**
        - Se extrae la fecha mínima de 'StartTime'.
        - Se utiliza la función `obtener_fecha_lunes` (asumiendo que está definida previamente) para obtener el lunes de la semana correspondiente a dicha fecha mínima.
        - Se convierte la fecha del lunes a un valor entero para facilitar el cálculo del identificador de solución.

    2. **Crear una lista de tuplas minimizadas:**
        - Se recorren las filas del DataFrame original.
        - Para cada fila, se minimiza el nombre de la tarea (eliminando espacios y convirtiéndolo a minúsculas).
        - Se crea una tupla que combina el nombre minimizado de la tarea y el valor de 'BatchID'.
        - Se agrega la tupla a una lista `mission_list`.

    3. **Crear un DataFrame con las tareas minimizadas únicas:**
        - Se utiliza la función `set()` para eliminar duplicados de la lista `mission_list`.
        - Se crea un nuevo DataFrame `minimal_mission_list` a partir de las tuplas únicas.
        - Se ordena el `minimal_mission_list` por la columna 'BatchID'.
        - Se eliminan los índices del DataFrame temporal creado por la ordenación y se conservan solo las columnas.

    4. **Asignar identificadores de solución y crear el DataFrame de salida:**
        - Se inicializa una lista `solutionid_list` para almacenar las tuplas que representan cada fila del DataFrame de salida.
        - Se utiliza un contador `k` para generar un número entero único dentro de cada combinación de 'taskName_minimal' y 'BatchID'.
        - Se recorre el DataFrame `minimal_mission_list` (que contiene las tareas minimizadas únicas).
            - Para cada fila del `minimal_mission_list`:
                - Se recorre el DataFrame original (`df`).
                - Se busca una coincidencia entre el nombre minimizado de la tarea actual del `minimal_mission_list` y el nombre minimizado de la tarea del DataFrame original, además de verificar que el 'BatchID' también coincida.
                - Si se encuentra una coincidencia, se calcula el identificador de solución:
                    - Se combina la fecha del lunes convertida a entero, un multiplicador de 1000000 y el contador `k`.
                - Se crea una tupla con el identificador de solución calculado, la fecha y hora de inicio de la tarea original, el nombre minimizado de la tarea y el nombre original de la tarea.
                - Se agrega la tupla a la lista `solutionid_list`.
                - Se incrementa el contador `k`.

    5. **Crear el DataFrame de salida:**
        - Se crea un nuevo DataFrame `solutionid_df` a partir de la lista `solutionid_list`.
        - Se ordena el `solutionid_df` por la columna 'StartTime'.
        - Se eliminan los índices del DataFrame temporal creado por la ordenación y se conservan solo las columnas especificadas.

    6. **Retorno:**
        - Se devuelve el `solutionid_df` final que contiene las columnas 'Sol_id', 'StartTime', 'taskName_minimal', y 'taskName'.

    """

    fecha = int(BatchID(obtener_fecha_lunes(df['StartTime'].min())))

    top = len(df)
    
    batchid_list = list(df['BatchID'])
    starttime = list(df['StartTime'])
    mission_list = []
    for i in range(top):
        mission_list.append((taskName_content[i].replace(' ', '').lower(), batchid_list[i]))
    columns=['taskName', 'BatchID']
    minimal_mission_list = pd.DataFrame(list(set(mission_list)), columns=columns).sort_values(by='BatchID').reset_index()[columns]

    solutionid_list = []
    k = 0
    columns=['Sol_id', 'StartTime', 'taskName_minimal', 'taskName']
    for i in range(len(minimal_mission_list)):
        for j in range(top):
            if \
                minimal_mission_list['taskName'].iloc[i] == taskName_content[j].replace(' ', '').lower() and \
                minimal_mission_list['BatchID'].iloc[i] == batchid_list[j]:

                solutionid_list.append((fecha * 1000000 + k, starttime[j], minimal_mission_list['taskName'].iloc[i], taskName_content[j]))

        k += 1

    solutionid_df = pd.DataFrame(solutionid_list, columns=columns).sort_values(by='StartTime').reset_index()[columns]

    return solutionid_df

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
            if 'final.xlsx' in nombre_fichero:
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
file_countries      = os.path.join(rootes['database'], 'countries.xlsx')
file_institutions   = os.path.join(rootes['database'], 'instituciones.xlsx')
directory = os.path.dirname(file)

# main_description: Leyendo los dataframes de partida
# print(av_ag(agenda, 'Leyendo los dataframes de partida'))
files = {
    'file1'     : ['data - copia.xlsx', 'Hoja1'],
    'file2'     : [file, 'Progresion de Accesos'],
    'file3'     : [file_countries, 'Hoja1'],
    'file4'     : [file_institutions, 'Hoja1'],
    'output'    : 'output.csv',
}

simulation      = pd.read_excel(files['file2'][0], sheet_name=files['file2'][1])
countries       = pd.read_excel(files['file3'][0], sheet_name=files['file3'][1])
institutions_df = pd.read_excel(files['file4'][0], sheet_name=files['file4'][1])

countries_list  = list(countries['Pais'])
inst_reference  = list(institutions_df['Indicador'])
inst_label      = list(institutions_df['Institucion'])

simulation.columns = [
    'Date', 'Start Time (UTCG)', 'Stop Time (UTCG)', 'Duration (sec)',
    'From Pass', 'To Pass', 'From Start Lat (deg)', 'From Start Lon (deg)',
    'From Start Alt (km)', 'From Stop Lat (deg)', 'From Stop Lon (deg)',
    'From Stop Alt (km)', 'To Start Lat (deg)', 'To Start Lon (deg)',
    'To Start Alt (km)', 'To Stop Lat (deg)', 'To Stop Lon (deg)',
    'To Stop Alt (km)', 'From Pass End', 'To Pass End', 'To Object',
    'From Object', 'To Parent', 'From Parent', 'GLat-Signum', 'GLon-Signum',
    'Inclination', 'Sub-Sat Lat(deg)', 'Sub-Sat Lon(deg)', 'Distance(Km)',
    'Roll Angle (deg)', 'Extension(Km2)', 'HRC/IRC (Teorico)', 'Index'
]


# main_description: Asignando BatchIDs y Workmodes
print(av_ag(agenda, 'Asignando BatchIDs y Workmodes'))
date_range = []
for i in range(10):
    new_date = simulation['Date'].iloc[0] + timedelta(i)
    date_range.append(BatchID(new_date))

Access_df = []
for i in date_range:
    Date_Code_BatchID = int(i)
    Access = BatchID_missions_table(simulation, Date_Code_BatchID)
    if len(Access) > 0:
        Access_df.append(Access)

# main_description: Concatenando segmentos
print(av_ag(agenda, 'Concatenando segmentos'))
Access_final_df = pd.concat(Access_df, axis=0)

# main_description: Reetiquetando columna de angulos de Roll
print(av_ag(agenda, 'Reetiquetando columna de angulos de Roll'))
top = len(Access_final_df)

RollAngle = [_ for _ in range(top)]
for i in range(top):
    if 'ACCESOS' in Access_final_df['To Object'].iloc[i]:
        RollAngle[i] = 'Playback'
    else:
        RollAngle[i] = Access_final_df['Roll Angle (deg)'].iloc[i]

Access_final_df['Roll Angle (deg)'] = RollAngle

# main_description: Reordenando los renglones
print(av_ag(agenda, 'Reordenando los renglones'))
taskName_to_object  = list(Access_final_df['To Object'])
realtimes_index = extract_list('Realtime', taskName_to_object)[1]
Access_final_df = permutar_pares(Access_final_df, realtimes_index)

# main_description: Asignando Instituciones y Paises
print(av_ag(agenda, 'Asignando Instituciones y Paises'))

taskName_content    = [str(i).replace('ACCESOS Realtime  ', '').replace('ACCESOS Playback  ', '') for i in taskName_to_object]
Satellite           = ['VRSS-2' for _ in range(top)]
PayLoad             = ['HRC/IRC' for _ in range(top)]
Status              = ['VerifySuccess' for _ in range(top)]
SunAngle            = ['-' for _ in range(top)]
SendStatus          = ['Envio Manual por Falla de Sistema' for _ in range(top)]
countries           = contejar_cadenas(taskName_content, countries_list, countries_list)
instituciones       = contejar_cadenas(taskName_content, inst_reference, inst_label)

nan_content         = [np.nan for _ in range(top)]

Access_final_df['To Object'] = taskName_content
Access_final_df['From Object'] = Satellite
Access_final_df['Institucion'] = instituciones
Access_final_df['countries'] = countries
Access_final_df['SolutionId'] = nan_content
Access_final_df['PayLoad'] = PayLoad
Access_final_df['SunAngle'] = SunAngle
Access_final_df['Status'] = Status
Access_final_df['SendStatus'] = SendStatus

# main_description: Renombrando columnas
print(av_ag(agenda, 'Renombrando columnas'))
fields = {
    'To Object'         : 'taskName',
    'SolutionId'        : 'SolutionId',
    'BatchID'           : 'BatchID',
    'Start Time (UTCG)' : 'StartTime',
    'Stop Time (UTCG)'  : 'EndTime',
    'From Object'       : 'Satellite',
    'PayLoad'           : 'PayLoad',
    'SunAngle'          : 'SunAngle',
    'Roll Angle (deg)'  : 'RollAngle',
    'Status'            : 'Status',
    'Duration (sec)'    : 'Duration',
    'Workmodes'         : 'Workmode',
    'Institucion'       : 'Institucion',
    'countries'         : 'countries',
    'SendStatus'        : 'SendStatus',
}

Access_final_df.rename(columns=fields, inplace=True)
Access_final_df = Access_final_df.reset_index()
Access_final_df = Access_final_df[list(fields.values())]

# main_description: Asignando SolutionIDs
print(av_ag(agenda, 'Asignando SolutionIDs'))
solutionid_df = assing_solutionid(Access_final_df)
solutionid_list = list(solutionid_df['Sol_id'])
Access_final_df['SolutionId'] = solutionid_list

# main_description: Exportando archivo
print(av_ag(agenda, 'Exportando archivo'))
file = os.path.join(directory, files['output'])
print(file)
# print(Access_final_df)
Access_final_df.to_csv(file)
