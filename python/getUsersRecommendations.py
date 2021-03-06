import csv
try:
    import sys
    sys.path.append(sys.argv[1] + "\lib\site-packages")
    from collections import defaultdict
    from surprise import Reader, Dataset, SVD, SVDpp
    import sqlite3
except:
    print("erreur import")
    exit()

def get_top_n(predictions, n=10):
    top_n = defaultdict(list)
    for uid, iid, true_r, est, _ in predictions:
        top_n[uid].append((iid, est))

    for uid, user_ratings in top_n.items():
        user_ratings.sort(key=lambda x: x[1], reverse=True)
        top_n[uid] = user_ratings[:n]

    return top_n


if __name__ == '__main__':

    file_path = "csv/ratings.csv"
    reader = Reader(line_format='user item rating timestamp', sep=',')
    data = Dataset.load_from_file(file_path, reader=reader)

    trainset = data.build_full_trainset()
    algo = SVD()
    algo.fit(trainset)

    testset = trainset.build_anti_testset()
    predictions = algo.test(testset)

    top_n = get_top_n(predictions, 10)

    con = sqlite3.connect("../database.db")
    cur = con.cursor()
    cur.execute("DROP TABLE IF EXISTS userRecommendations;")
    cur.execute("CREATE TABLE userRecommendations (idUser int, idFilm1 int, idFilm2 int, idFilm3 int, idFilm4 int, idFilm5 int, idFilm6 int, idFilm7 int, idFilm8 int, idFilm9 int, idFilm10 int, CONSTRAINT PK_userRecommandation PRIMARY KEY (idUser));")

    for uid, user_ratings in top_n.items():
        values = str(uid)
        for (iid, _) in user_ratings:
            values = values + ", " + str(iid)
        cur.execute("INSERT INTO userRecommendations VALUES(" + values + ");")

    con.commit()
    con.close()