import json
from modulo.mysql_on_db import reset_cont


 # Read the JSON file
with open(r"F:\MyProjects\laravel_projects\sugycom\py_scripts\db_options.json") as f1:
    rootes = json.load(f1)

S_base_datos = 'sugycom'
S_tabla = rootes['db_table']

reset_cont(S_base_datos, S_tabla)
