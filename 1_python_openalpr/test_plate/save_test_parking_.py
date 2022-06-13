from pyModbusTCP.client import ModbusClient
from threading import Thread
import time


c = ModbusClient(host="172.16.151.175", port=5007, unit_id=1, auto_open=True)


c.write_single_coil(0,0)
c.write_single_coil(1,0)
c.write_single_coil(6,0)

def ouvertureBarriereEntree(d):
    d.write_single_coil(0,1)
    time.sleep(2)
    d.write_single_coil(6,0)
    d.write_single_coil(7,1)
    
def fermetureBarriereEntree(d):
    d.write_single_coil(7,0)
    d.write_single_coil(6,1)
    time.sleep(2)
    d.write_single_coil(0,0)

def ouvertureBarriereSortie(d):
    d.write_single_coil(1,1)
    
    
def fermetureBarriereSortie(d):
    d.write_single_coil(1,0)
    

def test(message):
    print(message)

def thread_gestion_entree(threadname):
    global c
    
    
    while True:
        presence = c.read_coils(2,1)
        if presence[0] == True:
            # lancer un snapshot de la camera
            # lancer openalpr
            # requeter la base
            # si presence en bas alors ouvrir barriere
            #    et afficher plaque sur afficheur defilant + nom en vert
            # sinon afficher plaque non reconnue en rouge sur l'afficheur defilant
            ouvertureBarriereEntree(c)
            #c.write_single_coil(0,1)
            time.sleep(15)
            presence_sous_barriere = c.read_coils(3,1)
            while presence_sous_barriere[0] == True:
                presence_sous_barriere = c.read_coils(3,1)
                print("vehicule sous barriere")
            time.sleep(15)
            #c.write_single_coil(0,0)
            fermetureBarriereEntree(c)
            
            # tempo 15 secondes
            # tant que vehicule sous barriere attendre
            # tempo
            # fermer barriere
            
            
            
       
    

def thread_gestion_sortie(threadname):
    global c
    
def thread_gestion_manuelle(threadname):
    global c


thread_entree = Thread( target=thread_gestion_entree, args=("Thread-Entree", ) )
thread_sortie = Thread( target=thread_gestion_sortie, args=("Thread-Sortie", ) )
thread_manuel = Thread( target=thread_gestion_manuelle, args=("Thread-Manuel", ))

thread_entree.start()
thread_sortie.start()
thread_manuel.start()

thread_entree.join()
thread_sortie.join()
thread_manuel.join()
