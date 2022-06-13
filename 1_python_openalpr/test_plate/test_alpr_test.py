import sys, json
sys.path.append('./class/')
from _alpr import projet_alpr

recon = projet_alpr('eu', 2)
print(recon.recognize('../frame/picture12'))

"""result = recon.read_plate_json(recon.set_img_id('../frame/picture12'))
# b'plate0: 2 results\n    - AC517BK\t confidence: 89.1682\n    - AC5178K\t confidence: 82.1501\n'
pythonObj = json.loads(result)
print(type(pythonObj))
result_ = pythonObj['results'][0]['plate']
print(result_)"""