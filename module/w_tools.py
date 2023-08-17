import requests
from bs4 import BeautifulSoup
import speech_recognition as sr

def Reconocimiento():
    r = sr.Recognizer()
    with sr.Microphone() as source:
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