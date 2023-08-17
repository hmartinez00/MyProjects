from module.w_tools import Reconocimiento, raspado, obtener_microfonos_disponibles

# ans = Reconocimiento()
# print(ans)

# url = 'https://www.biblegateway.com/passage/?search=proverbios+3%3A5-6&version=RVR1960'
# tags = raspado(url)
# print(tags)

 # Ejemplo de uso
microfonos = obtener_microfonos_disponibles()
for microfono in microfonos:
    print(f"Indice: {microfono['indice']}, Nombre: {microfono['nombre']}")