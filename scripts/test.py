import pandas as pd
from datetime import datetime as dt
from General_Utilities.fecha import BatchID, dttostr

# Extrayendo los datos del Dataframe
file = r'C:\Users\admin\Downloads\Telegram Desktop\Planes Satelitales 20230823 - 20230829\Seleccion de Misiones\Control de Prioridades 20211114 191837.csv'
df = pd.read_csv(file)
df['id'] = [i for i in range(len(df))]
df.set_index('id', inplace=True)
# df.index.name = None

# Renombrando las columnas
df.columns = [
    'created_at',
    'satellite',
    'target',
    'latitude',
    'longitude',
    'duration',
    'vh_angle',
    'mode',
    'sensor',
    'status',
    'code',
    'updated_at',
    'closing_date',
]
df = df[
    [
        'satellite',
        'target',
        'latitude',
        'longitude',
        'duration',
        'vh_angle',
        'mode',
        'sensor',
        'status',
        'code',
        'created_at',
        'updated_at',
        'closing_date',
    ]
]

# Formateando las fechas
df['created_at'] = pd.to_datetime(df['created_at'], format='%m/%d/%Y %H:%M')
df['created_at'] = df['created_at'].dt.strftime('%Y-%m-%d %H:%M:%S')
df['updated_at'] = pd.to_datetime(df['updated_at'], origin='1899-12-30', unit='D', errors='coerce').dt.strftime('%Y-%m-%d %H:%M:%S')

# Asignando codigos
current_date = BatchID(dt.now())
counter = 0
for i, value in enumerate(df['code']):
    if pd.isnull(value):
        counter += 1
        new_code = f"oms-{current_date}{counter:04d}"
    else:
        new_code = value
    
    df.loc[i, 'code'] = new_code

# Completando fechas
for i, value in enumerate(df['updated_at']):
    if pd.isnull(value):
        new_value = dttostr(dt.now())
    else:
        new_value = value
    
    df.loc[i, 'updated_at'] = new_value



print(df)
