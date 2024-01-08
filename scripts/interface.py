import os
import tkinter as tk
from datetime import datetime


def time():
    hour = datetime.now().time().strftime("%H:%M:%S")
    return hour

# Definimos las funciones que se ejecutarán al hacer click sobre los botones
def boton1_click():
    hour = time()
    output = os.getcwd()
    texto.insert(tk.END, f"[{hour}]\t{output}\n")

def boton2_click():
    hour = time()
    texto.insert(tk.END, f"[{hour}]\tSe hizo click en el botón 2 \n")

# Creamos la ventana principal
root = tk.Tk()
root.title("Interfaz gráfica con Python")

# Creamos los botones
boton1 = tk.Button(root, text="Botón 1", command=boton1_click)
boton2 = tk.Button(root, text="Botón 2", command=boton2_click)

# Creamos el widget de texto
texto = tk.Text(root)
texto.config(width=50, height=10)

# Creamos la barra deslizante
barra_deslizante = tk.Scrollbar(root)

# Asociamos la barra deslizante con el widget de texto
barra_deslizante.config(command=texto.yview)
texto.config(yscrollcommand=barra_deslizante.set)

# Establecemos la propiedad orient de la barra deslizante en vertical
barra_deslizante.config(orient="vertical")

# Colocamos la barra deslizante en la ventana
barra_deslizante.pack(side="right", fill="y")
texto.pack(side="left", fill="both", expand=True)

# Colocamos los botones en la ventana
boton1.pack()
boton2.pack()
texto.pack()

# Ejecutamos el ciclo mainloop()
root.mainloop()
