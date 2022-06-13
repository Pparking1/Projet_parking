from posixpath import split
import os, time, sys
sys.path.append("./class/")
from _ffmpeg import jpeg
from _alpr import projet_alpr
from pyModbusTCP.client import ModbusClient

def main():
    # test_modbus()
    test_ffmpeg()
    #alpr_split()
    # test_ffmpeg()
    # modbus_test()

def test_modbus():
    c = ModbusClient(host="172.16.151.195", port=5007, unit_id=1, auto_open=True)
    value = c.read_coils(0,1)
    print(value)
    value = c.read_coils(1,1)
    print(value)
    c.write_single_coil(1,1)
    # lssl
    modbus = projet_modbus()
    print(modbus.state_bar_in)
    print(modbus.in_state())

def test_ffmpeg():
    jpg = jpeg()
    jpg.new_img_in()
    jpg.new_img_out()

def test_time():
    current_time = time.localtime()
    current_img = time.strftime('%Y-%m-%d_%H:%M:%S', current_time)
    print(current_img)
if __name__ == "__main__":
    main()
"""
def alpr_split():
    alpr = projet_alpr()
    arg = 'alpr -c ' + alpr.region + ' ../frame/picture1.jpg -n 1'
    result = os.popen(arg, 'r', 1)
    result.read()
    print(result)
    # self.put_logjson(result)"""
"""
def test_ffmpeg():
    jpg = jpeg()
    recon = projet_alpr(5, 'eu', './')
    recon.set_img_id(jpg.new_img_out())
    recon.alpr.recognize_file()
    recon.read_plate("../frame/parking_out/")
    # return jpg
"""
