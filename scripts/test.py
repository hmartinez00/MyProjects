import pandas as pd
from ManageDB.sqlite_on_db import selectall

db = r'C:\Users\admin\Documents\0 - A Repositorios GitHub\Devocionales\2tim4_1.db'
table = 'plan_biblia_52'
df = selectall(db, table)

print(df)