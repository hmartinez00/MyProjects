from modulos.exec.exec_module import generar_TCPLAN, generar_CPLAN2, generar_archivos, actualiza_DB
import json
import datetime
from General_Utilities.fecha import BatchID

def change_to_datetime(date_str):
    date_obj = datetime.datetime.strptime(date_str, '%Y-%m-%d')
    return date_obj

 # Read the JSON file
with open("F:\MyProjects\laravel_projects\sugycom\py_scripts\data_trigger.json") as f:
    data = json.load(f)

starttime = change_to_datetime(data['starttime'])
endtime = change_to_datetime(data['endtime'])

# Create a list of all the dates between the start and end dates
dates = []
for i in range(int((endtime - starttime).days) + 1):
    date = int(BatchID(starttime + datetime.timedelta(days=i)))
    dates.append(date)

# Print the list of dates
Date_Code_BatchID = dates[0]

mode = False
Date_Code_BatchID = generar_CPLAN2(mode, Date_Code_BatchID)

mode = False
container = generar_archivos(mode)