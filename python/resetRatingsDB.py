import csv
try:
    import sys
    import sqlite3
except:
    print("erreur import")
    exit()

if __name__ == '__main__':
    con = sqlite3.connect("database.db")
    cur = con.cursor()
    cur.execute("DROP TABLE IF EXISTS ratings")
    cur.execute("CREATE TABLE ratings (idUser int, idMovie int, rating decimal, timestamp int, CONSTRAINT PK_ratings PRIMARY KEY (idUser,idMovie));")

    with open('csv/ratings.csv', newline='', encoding="utf8") as csv_file:
        csv_reader = csv.reader(csv_file, delimiter=',')
        line_count = 0
        for row in csv_reader:
            if line_count > 0:
                cur.execute("INSERT INTO ratings VALUES(?,?,?,?);",(row[0],row[1],row[2],row[3]))
            line_count+=1

    con.commit()
    con.close()