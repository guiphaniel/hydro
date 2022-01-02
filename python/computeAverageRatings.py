import csv
try:
    import sys
    import pandas as pd
    import sqlite3
except:
    print("erreur import")
    exit()

if __name__ == '__main__':
    con = sqlite3.connect("database.db")
    cur = con.cursor()
    data = pd.read_csv('csv/ratings.csv', header=None)
    mean = data.groupby(1)[2].mean()
    for x in mean.index:
        cur.execute("UPDATE movies SET rating = ? WHERE idMovie=?",(x,mean[x]))
    con.commit()
    con.close()
