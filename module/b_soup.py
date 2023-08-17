from bs4 import BeautifulSoup
import requests
import webbrowser
from datetime import datetime, timedelta
from General_Utilities.fecha import BatchID


fecha = input('Introduzca la fecha: ')
fecha = datetime.strptime(fecha, '%Y%m%d')
delay_fecha = BatchID(
    fecha - timedelta(days=100)
)
print(delay_fecha)

labuenasemilla = f'https://labuenasemilla.net/{delay_fecha}'

response = requests.get(labuenasemilla)
bs = BeautifulSoup(response.text, 'html.parser')
links = bs.find_all('p')
Proverbio = str(links[-1]).split('Proverbios')[1].split('<')[0]
cap = Proverbio.split(':')[0]
vers = Proverbio.split(':')[1]

# # https://www.biblegateway.com/passage/?search=proverbios+3%3A5-6&version=RVR1960
# bible = 'https://www.biblegateway.com/versions/Reina-Valera-1960-RVR1960-Biblia/'
bible = 'https://www.biblegateway.com/passage/?search=proverbios+' + \
    cap + '%3A' + vers + '&version=RVR1960'

# Open URL in a new tab, if a browser window is already open.
webbrowser.open_new_tab(labuenasemilla)
webbrowser.open_new_tab(bible)

