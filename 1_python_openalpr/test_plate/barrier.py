import socket


class barrier:
    def __init__(self, udp_ip, udp_port):
        self.HOST = udp_ip
        self.PORT = udp_port
        # trame
        self.up_b1 = b"11"
        self.up_b2 = b"21"
        self.down_b1 = b"10"
        self.down_b2 = b"20"

    def get_ip(self):
        return self.HOST

    def get_port(self):
        return self.PORT

    def set_ip(self, ip):
        self.HOST = ip

    def set_port(self, port):
        self.PORT = port

    def open_1(self):
        sock = socket.socket(socket.AF_INET,  # Internet
                             socket.SOCK_DGRAM)  # UDP
        sock.sendto(self.up_b1, (self.HOST, self.PORT))

    def open_2(self):
        sock = socket.socket(socket.AF_INET,  # Internet
                             socket.SOCK_DGRAM)  # UDP
        sock.sendto(self.up_b2, (self.HOST, self.PORT))

    def close_1(self):
        sock = socket.socket(socket.AF_INET,  # Internet
                             socket.SOCK_DGRAM)  # UDP
        sock.sendto(self.down_b1, (self.HOST, self.PORT))

    def close_2(self):
        sock = socket.socket(socket.AF_INET,  # Internet
                             socket.SOCK_DGRAM)  # UDP
        sock.sendto(self.down_b2, (self.HOST, self.PORT))

    # oui
    """
    UDP_IP = "172.16.151.121"
    UDP_PORT = 8888
    serv_ip = "213.245.30.14"
    serv_port = 80
    port = 4023

    up_b1 = b"11"
    up_b2 = b"21"
    down_b1 = b"10"
    down_b2 = b"20"
    """
