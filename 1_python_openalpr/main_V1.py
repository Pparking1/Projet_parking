import sys, time, threading
from unittest import expectedFailure
sys.path.append('./class/')
from pyModbusTCP.client import ModbusClient
from _ffmpeg import jpeg
from _alpr import projet_alpr
from _sql import _bdd
from flask import Flask, request
from flask_cors import CORS
from waitress import serve
import socket
import urllib.parse

mutex = threading.Lock()
# class modbus
c = ModbusClient(host="172.16.151.175", port=5007, unit_id=1, auto_open=True)
# class flask
appFlask = Flask(__name__)
cors = CORS(appFlask)
# class pour prendre snapshot
snap = jpeg()
a = projet_alpr('eu', 2)

# mutex.acquire()
# bed = c.read_coil()
# 
sql = _bdd('openalpr', 'openalpr', 'localhost', 3306, 'projet_parking')

@appFlask.route('/set_modbustcp')
def access_param_set():
    print('ouverture barriere')
    coil = request.args.get('coil')
    value = request.args.get('value')
    mutex.acquire()
    c.write_single_coil(int(coil),int(value))
    mutex.release()
    return "ok"
    
@appFlask.route('/get_modbustcp')
def access_param_get():
    print('get info barriere')
    coil = request.args.get('coil')
    mutex.acquire()
    retoure = str(c.read_coils(int(coil),1))
    mutex.release()
    return retoure

@appFlask.route('/maj_afficheur')
def access_param_aff():
    print('maj afficheur')
    info = request.args.get('i')
    sent_ms('172.16.151.189', 5000, info)
    return "ok"

c.write_single_coil(0,0)
c.write_single_coil(1,0)
c.write_single_coil(6,0)
c.write_single_coil(7,0)

def calcul_checksum(message):
    cs = 0
    for i in message:
        cs = cs ^ ord(i)
    return cs

def sent_ms(HOST, PORT, message, color='red'):
    client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    client.connect((HOST, PORT))
    if color == 'red':
        hex_color = '<CC>'
    if color == 'green':
        hex_color = '<CF>'
    print('Connexion vers ' + str(HOST) + ':' + str(PORT) + ' reussie.')
    # cf    ci  cc
    Trame = '<L1><PA><FE><MA><WC><FE>' + hex_color +  message
    ms = '<ID00>' + Trame + '{:02X}'.format(calcul_checksum(Trame), 'X') + '<E>'
    print('Envoi de :' + ms)
    n = client.send(ms.encode())
    client.close()

def ouvertureBarriereEntree(d):
    mutex.acquire()
    d.write_single_coil(0,1)
    mutex.release()
    time.sleep(2)
    mutex.acquire()
    d.write_single_coil(6,0)
    mutex.release()
    mutex.acquire()
    d.write_single_coil(7,1)
    mutex.release()
    
def fermetureBarriereEntree(d):
    mutex.acquire()
    d.write_single_coil(7,0)
    mutex.release()
    mutex.acquire()
    d.write_single_coil(6,1)
    mutex.release()
    time.sleep(2)
    mutex.acquire()
    d.write_single_coil(0,0)
    mutex.release

def ouvertureBarriereSortie(d):
    mutex.acquire()
    d.write_single_coil(1,1)
    mutex.release()

def fermetureBarriereSortie(d):
    mutex.acquire()
    d.write_single_coil(1,0)
    mutex.release()

def test(message):
    print(message)

def thread_gestion_entree(threadname):
    global c, a, j, sql, mutex
    print("break 0 entre")
    while True:
        mutex.acquire()
        presence = c.read_coils(2,1)
        mutex.release()
        if presence[0] == True:
            print("Break 2 entre")
            # lancer un snapshot de la camera
            date = snap.new_img_in()
            # lancer openalpr
            plate = a.recognize("../frame/parking_in/" + date)
            print("\nNNNNNNNNNNN\n"+plate+"\nNNNNNNNNNNNN")
            # requeter la base
            result = sql.verif_plate(plate)
            print("Voici le resultat de la requete bdd ======= "+str(result))
            # si presence en bas alors ouvrir barriere
            if (result != []):
                print("Break 3 entre")
                #    et afficher plaque sur afficheur defilant + nom en vert
                sent_ms('172.16.151.189', 5000, 'Bienvenue', 'red')
                print("Ouverture barriere entre")
                #   ouvrir barriere
                ouvertureBarriereEntree(c)
                #c.write_single_coil(0,1)
                time.sleep(15)
                mutex.acquire()
                presence_sous_barriere = c.read_coils(3,1)
                mutex.release()
                print(presence_sous_barriere)
                while presence_sous_barriere[0] == True:
                    mutex.acquire()
                    presence_sous_barriere = c.read_coils(3,1)
                    mutex.release()
                    print("vehicule sous barriere")
                time.sleep(15)
                #c.write_single_coil(0,0)
                fermetureBarriereEntree(c)
                # On retire une place dans le parking
                # sql.parking_decremente(1)
                # tempo 15 secondes
                # tant que vehicule sous barriere attendre
                # tempo
                # fermer barriere
            
            # sinon afficher plaque non reconnue en rouge sur l'afficheur defilant
            else:
                print("Break 1 entre")
                sent_ms('172.16.151.189', 5000, "Vehicul non reconnue", "red")
                print("Barriere reste fermer")
                

def thread_gestion_sortie(threadname):
    global c, a, j, sql, mutex

    print("break 0 sortie")
    while True:
        mutex.acquire()
        presence = c.read_coils(4,1)
        mutex.release()
        if presence[0] == True:
            print("Break 2 sortie")
            # lancer un snapshot de la camera
            date = snap.new_img_out()
            # lancer openalpr
            plate = a.recognize("../frame/parking_out/" + date)
            print("\nNNNNNNNNNNN\n      "+plate+"\nNNNNNNNNNNNN")
            # requeter la base
            result = sql.verif_plate(plate)
            print("Voici le résultat de la requete bdd ======= "+str(result))
            # si presence en base alors ouvrir barriere
            if (result != []):
                print("Break 3 sortie")
                print("Ouverture barriere sortie")
                # ouvrir barriere
                ouvertureBarriereSortie(c)
                #c.write_single_coil(0,1)
                time.sleep(15)
                mutex.acquire()
                presence_sous_barriere = c.read_coils(3,1)
                mutex.release()
                print(presence_sous_barriere)
                while presence_sous_barriere[0] == True:
                    mutex.acquire()
                    presence_sous_barriere = c.read_coils(3,1)
                    mutex.release()
                print("vehicule sous barriere")
                # On retire une place dans le parking
                print("=======================================\n" +
                "================================\n")
                """rt = sql.parking_nb_place()
                print(rt)
                x, b = rt
                print(x)
                print(b)
                m, k = rt[0][0]
                print(m)
                print(k)"""
                # sql.parking_incremente(1)
                time.sleep(15)
                #c.write_single_coil(0,0)
                fermetureBarriereSortie(c)
                # tempo 15 secondes
                # tant que vehicule sous barriere attendre
                # tempo
                # fermer barriere
                # sinon afficher plaque non reconnue en rouge sur l'afficheur defilant
            else:
                print("Break 1 sortie")
                print("Barriere reste fermer") 

def thread_gestion_manuelle(threadname):
    global c, a, j, sql, appFlask, cors
    print('Break 0 manuel')
    serve(appFlask, host="0.0.0.0", port=9898)

#thread_gestion_entree()

thread_entree = threading.Thread( target=thread_gestion_entree, args=("Thread-Entree", ) )
thread_sortie = threading.Thread( target=thread_gestion_sortie, args=("Thread-Sortie", ) )
thread_manuel = threading.Thread( target=thread_gestion_manuelle, args=("Thread-Manuel", ))

thread_entree.start()
thread_sortie.start()
thread_manuel.start()

thread_entree.join()
thread_sortie.join()
thread_manuel.join()