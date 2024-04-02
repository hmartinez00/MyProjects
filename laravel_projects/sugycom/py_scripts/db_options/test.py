import os
import json
import pandas as pd

file = r'C:\Users\admin\Documents\Informes\2024\vacaciones\distribucion_de_guardias_ut_2024_2025 -1.csv'

dataf = pd.read_csv(file)

print(dataf.dtypes)

