import pyttsx3
import pyaudio
import requests
from bs4 import BeautifulSoup
import speech_recognition as sr


def Reconocimiento(ind):
    r = sr.Recognizer()
    with sr.Microphone(ind) as source:
        print('Te escucho: ')
        r.adjust_for_ambient_noise(source)
        audio = r.listen(source)

        with open('grabacion.wav', 'wb') as f:
            f.write(audio.get_wav_data())

    try:
        # text = r.recognize_google(audio, language="en-US")
        text = r.recognize_google(audio, language="es-ES")
    except:
        print('No te he entendido')

    return text

def raspado(url):
    response = requests.get(url)
    bs = BeautifulSoup(response.text, 'html.parser')
    links = bs.find_all('p')
    
    return links

def obtener_microfonos_disponibles():
    p = pyaudio.PyAudio()
    info = p.get_host_api_info_by_index(0)
    num_devices = info.get('deviceCount')
    microfonos = []
    for i in range(0, num_devices):
        device_info = p.get_device_info_by_host_api_device_index(0, i)
        if device_info.get('maxInputChannels') > 0:
            microfono = {
                'indice': i,
                'nombre': device_info.get('name')
            }
            microfonos.append(microfono)
    p.terminate()
    return microfonos

def voice_list():
    engine = pyttsx3.init()
    voices = engine.getProperty('voices')

    for voice in voices:
        print("ID:", voice.id)
        print("Name:", voice.name)
        print("Languages:", voice.languages)
        print("Gender:", voice.gender)
        print("Age:", voice.age)
        print("\n")

def talk(lectura):
    engine = pyttsx3.init()
    voices = engine.getProperty('voices')
    engine.setProperty('voice', voices[0].id)
    engine.say(lectura)
    engine.runAndWait()


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

