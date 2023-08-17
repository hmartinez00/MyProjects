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