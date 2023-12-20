import os
import tkinter as tk
from tkinter import filedialog
from General_Utilities.control_rutas import setting_routes
from General_Utilities.option_list import option_list


def routing():

    '''
    Funcion de gestion de rutas de acceso a la base de datos, y a los archivos. Debe devolver un diccionario.
    '''

    # key = 'resources'
    # directorio = setting_routes(key)[0]

    # folders = os.listdir(directorio)

    # if mode == True:
    #     compendium = directorio + option_list(folders[2:])
    # elif mode == False:
    #     compendium = directorio + folders[-1]

    root = tk.Tk()
    root.withdraw()
    compendium = filedialog.askdirectory()
    directorio = os.path.dirname(compendium)

    enrutamiento = {}
    enrutamiento['database'] = directorio + 'data/'
    enrutamiento['compendium'] = compendium
    enrutamiento['missions'] = compendium + '/Seleccion de Misiones/'
    enrutamiento['plans'] = compendium + '/Planes Satelitales/'

    return enrutamiento