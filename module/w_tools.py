import pyaudio
import requests
from bs4 import BeautifulSoup
import speech_recognition as sr
import sounddevice as sd
import scipy.io.wavfile as wav

def grabar_audio():
    fs = 44100  # Frecuencia de muestreo (puedes ajustarla según tus necesidades)
    duracion = 15  # Duración de la grabación en segundos (puedes ajustarla según tus necesidades)
     # Obtener los dispositivos de entrada disponibles
    dispositivos = sd.query_devices()
    for i, dispositivo in enumerate(dispositivos):
        print(f"Indice: {i}, Nombre: {dispositivo['name']}")
     # Configurar el dispositivo de grabación
    indice_dispositivo = 5  # Índice del dispositivo de grabación (ajústalo según tus necesidades)
    canal_dispositivo = dispositivos[indice_dispositivo]['max_input_channels']
    sd.default.device = (indice_dispositivo, canal_dispositivo)
     # Grabar el audio
    print("Iniciando grabacion...")
    audio = sd.rec(int(fs * duracion), samplerate=fs, channels=canal_dispositivo)
    sd.wait()  # Esperar a que termine la grabación
     # Guardar el audio en un archivo WAV
    nombre_archivo = "grabacion.wav"
    wav.write(nombre_archivo, fs, audio)
    print(f"Grabacion finalizada. Audio guardado en '{nombre_archivo}'.")

def Reconocimiento(ind):
    r = sr.Recognizer()
    with sr.Microphone(ind) as source:
    # with sr.WasapiLoopbackDevice() as source:
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
