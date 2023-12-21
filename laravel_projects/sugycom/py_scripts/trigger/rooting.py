import os
import json
from modulos.processes.routing_module import routing

rootes = routing()

print(rootes)

# file = r'F:\MyProjects\laravel_projects\sugycom\py_scripts\data_trigger.json'

#  # Open the JSON file.
# with open(file, 'r') as f:
#     data = json.load(f)

#  # Add the new value to the "roots" key.
# data['rootes'] = rootes

#  # Write the updated JSON file.
# with open(file, 'w') as f:
#     json.dump(data, f)