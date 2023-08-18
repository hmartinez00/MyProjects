import os
import json
import requests
from bs4 import BeautifulSoup
import speech_recognition as sr


def Reconocimiento(ind):
    r = sr.Recognizer()
    with sr.Microphone(ind) as source:
        print('Te escucho: ')
        r.adjust_for_ambient_noise(source)
        audio = r.listen(source)

        # with open('grabacion.wav', 'wb') as f:
        #     f.write(audio.get_wav_data())

    try:
        # text = r.recognize_google(audio, language="en-US")
        text = r.recognize_google(audio, language="es-ES")
    except:
        print('No te he entendido')

    return text

def reemplazar_espacios_archivo(nombre_archivo):
    lineas_modificadas = []
    
    # Leer el archivo y verificar cada línea
    with open(nombre_archivo, 'r', encoding='utf-8') as archivo:
        lineas = archivo.readlines()
        for linea in lineas:
            if linea.startswith(' '):
                # Reemplazar la línea eliminando el espacio inicial
                linea_modificada = linea.lstrip()
                lineas_modificadas.append(linea_modificada)
            else:
                lineas_modificadas.append(linea)
    
    # Escribir las líneas modificadas en el archivo
    with open(nombre_archivo, 'w', encoding='utf-8') as archivo:
        archivo.writelines(lineas_modificadas)

def raspado(url):
    response = requests.get(url)
    bs = BeautifulSoup(response.text, 'html.parser')
    links = bs.find_all('p')
    
    return links

class orders:

    def __init__(
        self,
        file,
        __dictado__
    ):

        self.file = file
        self.__dictado__ = __dictado__

        string = ''
        with open(self.file, encoding='utf-8') as f:
            for line in f:
                string = string + line
        
        self.string = string

    def close_options(self, __list__):
        if self.__dictado__ in __list__:        
            return True

    def secuence_options(self, __list__A, __list__B):
       
        if self.__dictado__ in __list__A:        
            for i in range(len(__list__A)):
                if self.__dictado__ == __list__A[i]:
                    j = i

            string = self.string + __list__B[j]
       
        else:
            string = self.string + ' ' + str(self.__dictado__)
        
        with open(self.file, 'w', encoding='utf-8') as f:
            f.write(string)
        f.close()

    def clear(self, __list__):
        if self.__dictado__ in __list__:
            string = ''
            with open(self.file, 'w', encoding='utf-8') as f:
                f.write(string)
            f.close()


def recognizer(ruta_archivo_json, file):

    with open(ruta_archivo_json) as archivo_json:
        datos_json = json.load(archivo_json)

    close_options = datos_json['voice_options']['close']
    secuence_optionsA = datos_json['voice_options']['secuence'][0]
    secuence_optionsB = datos_json['voice_options']['secuence'][1]
    clear_options = datos_json['voice_options']['clear']

    if os.path.isfile(file):
        pass
    else:
        string = ''
        with open(file, 'w', encoding='utf-8') as f:
            f.write(string)
        f.close()

    valor = False
    while valor == False:
        try:
            dictado = Reconocimiento(1)            
            objeto = orders(file, dictado)
            reemplazar_espacios_archivo(file)
            
            if objeto.close_options(close_options):
                break        
            objeto.secuence_options(secuence_optionsA, secuence_optionsB)
            objeto.clear(clear_options)
        
        except:    
            continue