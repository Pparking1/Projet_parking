from asyncio.windows_events import NULL
from pyModbusTCP.client import ModbusClient
import socket
# 0 = ferme/Entree
# 1 = ouvert/Sortie
class projet_modbus:
    def __init__(self,
    ip_barriere="176.16.151.195",
    port=5007,
    unit_id=1,
    auto_open=True):
        self.host = ip_barriere
        self.port = port
        self.unit_id = unit_id
        self.auto_open = auto_open
        self.Client = ModbusClient(self.host, self.port,self.unit_id, self.auto_open)
    
    def __del__(self):
        print('Object Modbus has destroyed!')
        
    def ouvertureBarriereEntree(self):
        self.Client.write_single_coil(0,1)
        self.time.sleep(2)
        self.Client.write_single_coil(6,0)
        self.Client.write_single_coil(7,1)
    
    def fermetureBarriereEntree(self):
        self.Client.write_single_coil(7,0)
        self.Client.write_single_coil(6,1)
        self.time.sleep(2)
        self.Client.write_single_coil(0,0)

    def ouvertureBarriereSortie(self):
        self.Client.write_single_coil(1,1)
        
    def fermetureBarriereSortie(self):
        self.Client.write_single_coil(1,0)
        
    def in_state(self):
        return self.Client.read_coils(0,1)

    def out_state(self):
        return self.Client.read_coils(0,1)
    
    def capteur_sous_bar_in(self):
        return self.Client.read_single_coils(3,1)

    def capteur_bar_in(self):
        return self.Client.read_single_coils(2,1)

    def capteur_sous_barout(self):
        return self.Client.read_single_coils(4,1)
    # 6 7
    def capteur_bar_out(self):
        return self.Client.read_single_coils(5,1)
        
    def set_host(self, host):
        self.host = host
        return self.host
    
    def set_port(self, port):
        self.port = port
        return self.port

    def set_unit_id(self, unit_id):
        self.unit_id = unit_id
        return self.unit_id

    def set_auto_open(self, auto_open):
        self.auto_open = auto_open
        return self.auto_open

"""
c = ModbusClient(host="172.16.151.195", port=5007, unit_id=1, auto_open=True)

value = c.read_coils(0,1)
print(value)
value = c.read_coils(1,1)
print(value)

c.write_single_coil(1,1)
"""