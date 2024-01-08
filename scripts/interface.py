import os
import tkinter as tk
import subprocess
from datetime import datetime


def time():
    hour = datetime.now().time().strftime("%H:%M:%S")
    return hour

# Definimos las funciones que se ejecutarán al hacer click sobre los botones
def boton1_click():
    hour = time()
    directory = os.getcwd()
    texto.insert(tk.END, f"[{hour}]\t{directory}\n")
    path = os.path.join(directory, 'laravel_projects', 'sugycom')
    # texto.insert(tk.END, "\n")
    # for archivo in os.listdir(output):
    #     texto.insert(tk.END, f"{archivo}\n")
    texto.insert(tk.END, path)
    process = subprocess.run(["npm", "run", "dev"], capture_output=True, cwd=path)
    output = process.stdout
    texto.insert(tk.END, output)

def boton2_click():
    hour = time()
    output = os.getcwd()
    texto.insert(tk.END, f"[{hour}]\t{output}\n")

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
