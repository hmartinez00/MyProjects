import os
import json
import tkinter as tk
from tkinter import filedialog
import shutil


 # Read the JSON file
with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\rootes.json") as f1:
    rootes = json.load(f1)

filename = os.path.basename(rootes['compendium'])
format = 'zip'
directory1 = rootes['plans']

root = tk.Tk()
root.withdraw()
directory2 = filedialog.askdirectory()

shutil.make_archive(filename, format, directory1)
shutil.copy(filename + '.zip', directory2)
os.remove(filename + '.zip')

print(f"El directorio se comprimió en el archivo {filename}.")
