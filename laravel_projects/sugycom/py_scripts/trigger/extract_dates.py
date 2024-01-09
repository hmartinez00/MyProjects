import json
from modulos.builders.extractorcplan_module import extract_dates
from modulos.processes.tcplanprepare_module import tcplanprepare2



with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\rootes.json") as f1:
    rootes = json.load(f1)

tcplanprepare2(rootes, True)
data = extract_dates(rootes)
print(data)