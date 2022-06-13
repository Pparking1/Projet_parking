from asyncore import write
from unittest import result
import json, sys, os, subprocess


class projet_alpr:
    def __init__(self, region = 'eu', n_prediction = 3):
        self.region = str(region)
        self.n_prediction = str(n_prediction)
        self.jsonObj = ''
        self.result = ''
        self.img_id = ''
    
    def recognize(self, img_path):
        result_json = self.read_plate_json(img_path)
        # print(result_json)
        # try: exept:
        self.jsonObj = json.loads(result_json)
        self.result = self.jsonObj['results'][0]['plate']
        return self.result

    def set_alpr(self, region = 'eu', n_prediction = 3,):
        self.region = region
        self.prediction_n = n_prediction

    def read_plate(self, img_path):
        arg = str('alpr '+ str(img_path)
        + '.jpg -c ' + str(self.region)
        + ' -n ' + str(self.n_prediction)) # + -j
        # result = os.popen(arg, 'w', 1)
        result = subprocess.check_output([arg], shell=True)
        self.result = result    # self.put_logjson(result)
        return result

    def read_plate_json(self, img_path):
        arg = str('alpr '+ str(img_path)
        + '.jpg -c ' + str(self.region)
        + ' -n ' + str(self.n_prediction)
        + ' -j')
        result = subprocess.check_output([arg], shell=True)
        self.json = result  # self.put_logjson(result)
        return result
    
    def put_log(self):
        file_text = open('log.txt', 'r')
        a = True
        while a:
            file_line = file_text.readline()
            if not file_line:
                file_text.write(self.json)
                a = False
        file_text.close()

    def set_img_id(self, id):
        self.img_id = id
        return self.img_id

    def get_img_id(self):
        return self.img_id

    def get_json(self):
        return self.json

"""arg = 'alpr -c' + str(self.region) + ' '
        + str(img_path) + str(self.img_id)
        + '.jpg -n ' + str(self.n_prediction)"""

"""
def __init__(self,
    prediction_n = 5,
    region = 'eu',
    conf_path = '/etc/openalpr/openalpr.conf',
    runtime_data = '/usr/share/openalpr/runtime_data/'):
        self.alpr = Alpr(region, conf_path, runtime_data)
        self.alpr.set_top_n(prediction_n)
        self.prediction_n = prediction_n
        self.runtime_data = runtime_data
        self.conf_path = conf_path
        self.region = region
        self.json = ""
        self.result = ""
        self.img_id = ""

    def set_alpr(self, region = 'eu',
                 conf_path = '/etc/openalpr/openalpr.conf',
                 runtime_data = '/usr/share/openalpr/runtime_data/'):
        self.alpr = Alpr(region, conf_path, runtime_data)

    def set_img_id(self, id):
        self.img_id = id

    def get_json(self):
        return self.json

    def read_plate(self, img_path):
        result = self.alpr.recognize_file(img_path + self.img_id + '.jpg')
        self.json = result
        # self.put_logjson(result)
        return result

    def put_log(self):
        file_text = open("log.txt", "r")
        a = True
        while a:
            file_line = file_text.readline()
            if not file_line:
                file_text.write(self.json)
                a = False
        file_text.close()
"""
"""arg2 = 'ffmpeg -rtsp_transport tcp -i \"' +\
              self.rtsp_in[0] +'\" -frames 1 '+\
              self.in_path +\
              self.date_in + '.jpg'"""

"""
b'{ "version":2,
    "data_type":"alpr_results",
    "epoch_time":1652384512878,
    "img_width":2560,
    "img_height":1440,
    "processing_time_ms":411.981201,
    "regions_of_interest":
        [
            {"x":0,"y":0,
             "width":2560,
             "height":1440
             }
        ],
    "results":
        [
            {"plate":"AC517BK",
             "confidence":89.168213,
             "matches_template":0,
             "plate_index":0,
             "region":"",
             "region_confidence":0,
             "processing_time_ms":65.847130,
             "requested_topn":2,
             "coordinates":
                [
                    {"x":1280,
                     "y":1210
                     },
                     {"x":1598,
                     "y":1224
                     },
                     {"x":1595,
                     "y":1281
                     },
                     {"x":1272,
                     "y":1266
                     }
                ],
             "candidates":
                [
                    {"plate":"AC517BK",
                     "confidence":89.168213,
                     "matches_template":0
                     },
                     {"plate":"AC5178K",
                      "confidence":82.150085,
                      "matches_template":0
                      }
                ]
            }
        ]
    }
    \n'"""

"""
import json

# json string
jsonStr =  '[{"name":"Tesla", "age":2, "city":"New York"}, { "name":"Tesla", "age":2, "city":"Boston"}]'

# parse json file
pythonObj = json.loads(jsonStr)
print(type(pythonObj))
print(type(pythonObj[0]))

city = pythonObj[1]['city']
print(city)
"""