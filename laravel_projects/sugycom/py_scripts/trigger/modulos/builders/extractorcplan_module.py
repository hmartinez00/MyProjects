import os
import pandas as pd
from datetime import datetime, timedelta
from modulos.processes.routing_module import routing
import tkinter as tk
from tkinter import filedialog


def batchid_status(dates):

    reference = dates.replace(hour=4, minute=40, second=0)

    if dates >= reference:
        result = dates.date()
    else:
        result = (dates - timedelta(days=1)).date()

    result = result.strftime('%Y-%m-%d')
    
    return result


def extract_dates(rootes):
    '''
    ABAE-SAT-UT-SGO
    Desarrollado por: Héctor Martínez (Jefe(E) Telecomunicaciones)
    Creación: 2024-03-01
    Actualización: 2024-03-01
      Script para extraccion de fechas del plan de misiones.
    '''

    key = 'missions'
    directorio = rootes[key]

    rutas = []
    for nombre_directorio, dirs, ficheros in os.walk(directorio):
        for nombre_fichero in ficheros:
            if 'final.xlsx' in nombre_fichero:
                ruta = nombre_directorio + '\\' + nombre_fichero
                rutas.append(ruta.replace('\\', '/'))

    archivo_0 = rutas[-1]

    misiones_0 = pd.read_excel(archivo_0, sheet_name='Progresion de Accesos')
      
    # dates = [
    #     misiones_0['Start Time (UTCG)'].min().strftime('%Y-%m-%d %H:%M:%S'),
    #     misiones_0['Start Time (UTCG)'].max().strftime('%Y-%m-%d %H:%M:%S')
    # ]
    dates = [
        misiones_0['Start Time (UTCG)'].min(),
        misiones_0['Start Time (UTCG)'].max()
    ]

    start   = batchid_status(dates[0])
    end     = batchid_status(dates[1])

    return start, end


def extractorcplan(rootes):
    '''
    ABAE-SAT-UT-SGO
    Desarrollado por: Héctor Martínez (Jefe(E) Telecomunicaciones)
    Creación: 2022-08-25
    Actualización: 2024-03-01
      Script para extraccion del plan de misiones con exportacion
      a *.csv.
    '''

    key = 'missions'
    # mode = True
    directorio = rootes[key]

    rutas = []
    for nombre_directorio, dirs, ficheros in os.walk(directorio):
        for nombre_fichero in ficheros:
            if 'final.xlsx' in nombre_fichero:
                ruta = nombre_directorio + '\\' + nombre_fichero
                rutas.append(ruta.replace('\\', '/'))


    # archivo_0 = input('Introduzca ruta del archivo: ')
    archivo_0 = rutas[-1]
    # print(archivo_0)

    tiempo = datetime.strftime(
        datetime.now()
        , '%Y%m%d%H%M%S'
    )

    misiones_0 = pd.read_excel(archivo_0, sheet_name='Progresion de Accesos')

    cabeceras = {}
    cabeceras[misiones_0.columns[32]] = 'HRC/IRC (Teorico)'

    misiones_0 = misiones_0.rename(
        columns = cabeceras
    )

    return misiones_0