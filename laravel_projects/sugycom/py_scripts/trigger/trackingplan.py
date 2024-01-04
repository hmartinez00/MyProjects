import os
import json
from modulos.builders.trackingplan_module import trackingplan


 # Read the JSON file
with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\rootes.json") as f1:
    rootes = json.load(f1)

mode = rootes['missions']

df = trackingplan(mode)

print(df)