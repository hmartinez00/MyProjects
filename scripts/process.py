import os
import subprocess

# print(os.getcwd())

path = os.path.join(os.getcwd(), 'laravel_projects', 'sugycom')
os.chdir(path)
subprocess.run("npm run dev", shell=True)
# process = subprocess.run(["npm", "run", "dev"], capture_output=True, cwd=path)
# print(process)
