from pyModbusTCP.client import ModbusClient
from flask import Flask, request
from flask_cors import CORS
from waitress import serve

c = ModbusClient(host="172.16.151.175", port=5007, unit_id=1, auto_open=True)

appFlask = Flask(__name__)
CORS(appFlask)

@appFlask.route('/set_modbustcp')
def access_param_set():
    coil = request.args.get('coil')
    value = request.args.get('value')
    c.write_single_coil(int(coil),int(value))
    return "ok"
 
@appFlask.route('/get_modbustcp')
def access_param_get():
    coil = request.args.get('coil')
    return str(c.read_coils(int(coil),1))

if __name__ == "__main__":
    serve(appFlask, host="0.0.0.0", port=9898)