import os
import json
import datetime
from General_Utilities.fecha import BatchID
from modulos.processes.routing_module import routing
from modulos.processes.files_organizer import files_organizer
from modulos.exec.exec_module import generar_TCPLAN, generar_CPLAN2, generar_archivos2, actualiza_DB


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

rootes = routing()

Date_Code_BatchID = generar_CPLAN2(rootes, Date_Code_BatchID)
container = generar_archivos2(rootes)

# ---------------------------------------------------------------------
# Organizando los archivos
# ---------------------------------------------------------------------
print('{}% Organizando archivos.'.format(int(8/8*100)))

dir_path = rootes['plans'] + f'Plan Satelital {Date_Code_BatchID}'

directory = os.getcwd()
extension1  =   'CPLAN2'
extension2  =   'OK'
extension3  =   'SETPARA2'
extension4  =   'RECEIVETASK'
directory1  =   dir_path + '/VRSS-2'
directory2  =   dir_path + '/Station Plan'
files_organizer(directory, extension1, extension2, extension3, extension4, directory1, directory2)