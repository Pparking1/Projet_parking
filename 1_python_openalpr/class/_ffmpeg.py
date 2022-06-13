import os, time

class jpeg:
    def __init__(self,
    rtsp_out = ["rtsp://admin:CAmera62@172.16.151.228/Streaming/Channels/1", 
    "rtsp://admin:CAmera62@172.16.151.228/Streaming/Channels/2"],
    rtsp_in = ["rtsp://172.16.151.219/Streaming/Channels/1",
    "rtsp://172.16.151.219/Streaming/Channels/2"],
    in_path = "../frame/parking_in/",
    out_path = "../frame/parking_out/"):
        self.rtsp_in = rtsp_in
        self.rtsp_out = rtsp_out
        self.in_path = in_path
        self.out_path = out_path
        self.date_in = ""
        self.date_out = ""

    def date(self):
        date = time.strftime('%Y-%m-%d_%H:%M:%S', time.localtime())
        return date

    def new_img_in(self):
        self.date_in = self.date()
        arg = 'ffmpeg -rtsp_transport tcp -i \"' +\
              self.rtsp_in[0] +'\" -frames 1 '+\
              self.in_path +\
              self.date_in + '.jpg'
        os.system(arg)
        return self.date_in

    def new_img_out(self):
        self.date_out = self.date()
        arg = 'ffmpeg -rtsp_transport tcp -i \"' +\
              self.rtsp_out[0] + '\" -frames 1 '+\
              self.out_path +\
              self.date_out + '.jpg'
        os.system(arg)
        return self.date_out

    def last_in(self):
        a = os.popen('ls ' + self.in_path + '*.jpg')
        a = a.read()
        print(a)
        return a
    
    def last_out(self):
        a = os.popen('ls ' + self.out_path + '*.jpg')
        a = a.read()
        print(a)
        return a


    # ffmpeg -rtsp_transport tcp -i "rtsp://172.16.151.219/Streaming/Channels/1" -frames 1 ./picture1.jpg
    """
    def take_screen(self):
	    arg = 'ffmpeg -rtsp_transport tcp -i \"'+addr+'\" -frames 1 ./frame/'+str(self.new_img)+'.jpg'
        # 'ffmpeg -rtsp_transport tcp -i \"'+self.flux_rtsp_in[1]+'\" -frames 1 ./frame/',self.new_img,'.jpg'
	    os.system(arg)"""
