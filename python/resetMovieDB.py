import csv
try:
    import sys
    import sqlite3
except:
    print("erreur import")
    exit()

if __name__ == '__main__':
    con = sqlite3.connect("../database.db")
    cur = con.cursor()
    cur.execute("DROP TABLE IF EXISTS movies")
    cur.execute("CREATE TABLE movies (idMovie int, title varchar(255), year varchar(4), genres varchar(255), rating float, CONSTRAINT PK_movies PRIMARY KEY (idMovie));")

    with open('csv/movies.csv', newline='', encoding="utf8") as csv_file:
        csv_reader = csv.reader(csv_file, delimiter=',')
        line_count = 0
        for row in csv_reader:
            if line_count > 0:
                date = row[1][len(row[1]) - 5:len(row[1]) - 1]
                count = 0
                while count!=len(row[1]) and row[1][count] != '(':
                    count += 1
                if row[1][count-6:count-1]==", The" or row[1][count-6:count-1]==", Les" :
                    title = row[1][0:count-6]
                elif row[1][count-4:count-1]==", A" :
                    title = row[1][0:count-4]
                elif row[1][count-5:count-1]==", An" or row[1][count-5:count-1]==", Le" or row[1][count-5:count-1]==", La":
                    title = row[1][0:count-5]
                else:
                    title = row[1][0:count - 1]
                cur.execute("INSERT INTO movies VALUES(?,?,?,?,?);",(row[0],title,date,row[2],0.0))
            line_count+=1
    con.commit()
    con.close()