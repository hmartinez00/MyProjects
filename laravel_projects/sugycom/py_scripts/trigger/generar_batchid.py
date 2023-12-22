import os
import json
import datetime
from General_Utilities.fecha import BatchID
from modulos.processes.files_organizer import files_organizer
from modulos.exec.exec_module import generar_TCPLAN2, generar_CPLAN2, generar_archivos2, actualiza_DB2


def change_to_datetime(date_str):
    date_obj = datetime.datetime.strptime(date_str, '%Y-%m-%d')
    return date_obj

 # Read the JSON file
with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\rootes.json") as f1:
    rootes = json.load(f1)

 # Read the JSON file
with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\data_trigger.json") as f2:
    data = json.load(f2)

date = change_to_datetime(data['date'])

# Create a list of all the dates between the start and end dates
# for i in range(int((endtime - starttime).days) + 1):
    # date = int(BatchID(starttime + datetime.timedelta(days=i)))
date = int(BatchID(date))
Date_Code_BatchID = generar_CPLAN2(rootes, date)
container = generar_archivos2(rootes)

# ---------------------------------------------------------------------
# Organizando los archivos
# ---------------------------------------------------------------------
print('{}% Organizando archivos.'.format(int(8/8*100)))

dir_path = rootes['plans'] + f'Plan Satelital {date}'

directory = os.getcwd()
extension1  =   'CPLAN2'
extension2  =   'OK'
extension3  =   'SETPARA2'
extension4  =   'RECEIVETASK'
directory1  =   dir_path + '/VRSS-2'
directory2  =   dir_path + '/Station Plan'
files_organizer(directory, extension1, extension2, extension3, extension4, directory1, directory2)


mode = False
actualiza_DB2(
    container,
    Date_Code_BatchID,
    rootes,
    mode
)