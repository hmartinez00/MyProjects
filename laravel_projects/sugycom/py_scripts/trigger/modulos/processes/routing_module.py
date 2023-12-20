import os
import tkinter as tk
from tkinter import filedialog


def routing():

    '''
    Funcion de gestion de rutas de acceso a la base de datos, y a los archivos. Debe devolver un diccionario.
    '''
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