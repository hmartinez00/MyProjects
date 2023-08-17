from General_Utilities.control_rutas import setting_routes
from module.w_tools import recognizer

key = 'voice'
ruta_archivo_json = setting_routes(key)[0]
recognizer(ruta_archivo_json)


# url = 'https://www.biblegateway.com/passage/?search=proverbios+3%3A5-6&version=RVR1960'
# tags = raspado(url)
# print(tags)
