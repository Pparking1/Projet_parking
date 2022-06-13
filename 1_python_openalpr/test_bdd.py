# Module Imports
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="openalpr",
  password="openalpr",
  database="projet_parking"
)

mycursor = mydb.cursor()

def select_vehicle():
  mycursor.execute("SELECT * FROM voiture")
  myresult = mycursor.fetchall()
  for x in myresult:
    print(x)

def add_plate(
  id_parking = '1',
  plate = '666',
  date_arrive_est_garer = '0',
  date_sortie_est_garer = '0',
  autorise = '0',
  date_prise = '0'):
  mycursor.execute("INSERT INTO `est_garer` (`Id_parking_parking`, " +
    "`immatriculation_voiture`, " +
    "`date_arrivée_est_garer`, " +
    "`date_sortie_est_garer`, " +
    "`autorise`, `date_prise`) " +
    "VALUES ('" + str(id_parking) + "', '" + str(plate) + "', " +
    "' " + str(date_arrive_est_garer) + "', " + # [2022-05-31 13:05:23]
    "' " + str(date_sortie_est_garer) + "', " + # [2022-05-31 19:47:23]
    "'" + str(autorise) + "', '" + str(date_prise) + "')") # 2022-05-31
  myresult = mycursor.fetchall()
  for x in myresult:
    print(x)

if __name__ == "__main__":
  add_plate()