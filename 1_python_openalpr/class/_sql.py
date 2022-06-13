import dbm
from tokenize import PlainToken
import sys, mysql.connector

class _bdd:
    def __init__(self,
    _user = 'openalpr',
    _password = 'openalpr',
    _host = 'localhost',
    _port = 3306,
    _database = 'projet_parking'):
        self.user = _user
        self.password = _password
        self.host = _host
        self.port = _port
        self.database = _database
        self.bdd_connect = mysql.connector.connect(
            host = self.host,
            user = self.user,
            password = self.password,
            database = self.database)
        # Get Cursor
        self.cur = self.bdd_connect.cursor()

    def search_plate(self, plate):
        self.cur.execute(
            "SELECT immatriculation_voiture FROM projet_parking WHERE immatriculation_voiture='"+str(plate))
        self.cur.execute(
            "SELECT IDutilisateur, IDplaque, utilisateur FROM utilisateur, possede WHERE "
        )
        "SELECT IDplaque, utilisateur FROM utilisateur INNER JOIN possede ON utilisateur.id_utilisateur_utilisateur = possede.IDutilisateur"
        "SELECT IDplaque, utilisateur FROM utilisateur INNER JOIN possede ON utilisateur.id_utilisateur_utilisateur = possede.IDutilisateur WHERE IDplaque='777'"
        "SELECT IDplaque, Nom_utilisateur FROM utilisateur INNER JOIN possede ON utilisateur.id_utilisateur_utilisateur = possede.IDutilisateur WHERE IDplaque='"+ str(plate) +"'"
    
    def verif_plate(self, plate):
        self.cur.execute(
            "SELECT IDplaque, Nom_utilisateur FROM utilisateur INNER JOIN possede ON utilisateur.id_utilisateur_utilisateur = possede.IDutilisateur WHERE IDplaque='"+ str(plate) +"'"
        )
        return self.cur.fetchall()
    
    def parking_incremente(self, id_parking):
        nb_place = self.parking_nb_place()
        nb = nb_place[0] + 1
        self.cur.execute(
            "UPDATE `parking` SET `Nombre_de_place_actuelle` = '" + str(nb) + "' WHERE `parking`.`Id_parking_parking` = 1;"
        )
        return nb_place

    def parking_decremente(self, id_parking):
        nb_place = int(self.parking_nb_place())
        nb = nb_place[0] - 1
        self.cur.execute(
            "UPDATE `parking` SET `Nombre_de_place_actuelle` = '" + str(nb) + "' WHERE `parking`.`Id_parking_parking` = 1;"
        )
        return nb_place

    def parking_nb_place(self):
        self.cur.execute(
            "SELECT `Nombre_de_place_actuelle` FROM `parking` WHERE 1"
        )
        return self.cur.fetchall()