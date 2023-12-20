import os
import json
from modulos.processes.routing_module import routing

rootes = routing()

file = os.path.dirname(os.getcwd()) + '/data_trigger.json'

 # Open the JSON file.
with open(file, 'r') as f:
    data = json.load(f)

 # Add the new value to the "roots" key.
data['rootes'] = rootes

 # Write the updated JSON file.
with open(file, 'w') as f:
    json.dump(data, f)