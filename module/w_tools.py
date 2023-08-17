import pyaudio
import requests
from bs4 import BeautifulSoup
import speech_recognition as sr

def Reconocimiento():
    r = sr.Recognizer()
    # with sr.Microphone() as source:
    with sr.WasapiLoopbackDevice() as source:
        print('Te escucho: ')
        r.adjust_for_ambient_noise(source)
        audio = r.listen(source)

    try:
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
