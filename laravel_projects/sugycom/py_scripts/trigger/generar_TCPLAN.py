import json
from modulos.exec.exec_module import generar_TCPLAN2

 # Read the JSON file
with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\rootes.json") as f1:
    rootes = json.load(f1)

mode = True
generar_TCPLAN2(rootes, mode)