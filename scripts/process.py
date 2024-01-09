import os
import subprocess
from datetime import datetime

# print(os.getcwd())

# path = os.path.join(os.getcwd(), 'laravel_projects', 'sugycom')
# os.chdir(path)
# subprocess.run("npm run dev", shell=True)

comand = 'npm run dev'

hour = datetime.now().time().strftime("%H:%M:%S")
path = os.path.join(os.getcwd(), 'laravel_projects', 'sugycom')
os.chdir(path)
process = subprocess.run(comand, shell=True, capture_output=True)
output = process.stdout
print(output)
