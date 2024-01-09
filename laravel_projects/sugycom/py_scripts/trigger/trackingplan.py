import os
import json
from modulos.builders.trackingplan_module import trackingplan
from modulos.processes.tcplanprepare_module import tcplanprepare2


 # Read the JSON file
with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\rootes.json") as f1:
    rootes = json.load(f1)

tcplanprepare2(rootes, True)
mode = rootes['missions']
df = trackingplan(mode)

print(df)
