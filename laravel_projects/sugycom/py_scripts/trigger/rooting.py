import os
import json
import tkinter as tk
from tkinter import filedialog


file = r"F:\MyProjects\laravel_projects\sugycom\py_scripts\rootes.json"

 # Read the JSON file
with open(file) as f1:
    rootes = json.load(f1)

rootes['database']      = str(rootes['database']).replace('\\', '')
rootes['compendium']    = str(rootes['compendium']).replace('\\', '')
rootes['missions']      = str(rootes['missions']).replace('\\', '')
rootes['plans']         = str(rootes['plans']).replace('\\', '')

# Guardar los datos actualizados en el archivo JSON
with open(file, 'w') as f:
    json.dump(rootes, f, indent=4)  # Añadir indentación para legibilidad

# file = 'F:/MyProjects/laravel_projects/sugycom/py_scripts/rootes.json'

# root = tk.Tk()
# root.withdraw()
# compendium = filedialog.askdirectory()
# directorio = os.path.dirname(compendium)

# database = directorio + '/data/'
# compendium = compendium
# missions = compendium + '/Seleccion de Misiones/'
# plans = compendium + '/Planes Satelitales/'

# # Cargar los datos del archivo JSON existente
# with open(file, 'r') as f:
#     data = json.load(f)

# # Actualizar los valores en el diccionario de datos
# data['database'] = database
# data['compendium'] = compendium
# data['missions'] = missions
# data['plans'] = plans

# # Guardar los datos actualizados en el archivo JSON
# with open(file, 'w') as f:
#     json.dump(data, f, indent=4)  # Añadir indentación para legibilidad