import json
from modulos.builders.extractorcplan_module import extract_dates


with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\rootes.json") as f1:
    rootes = json.load(f1)

data = extract_dates(rootes)
print(data)