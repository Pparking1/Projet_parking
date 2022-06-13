from barrier import barrier
import time, socket
# Press Maj+F10 to execute it or replace it with your code.
# Press Double Shift to search everywhere for classes, files, tool windows, actions, and settings.

timeout_seconds = 1
host = "172.16.151.150"
port = 8888


def print_hi():
    global host, port
    # Use a breakpoint in the code line below to debug your script.
    ping_()
    print("test des barrier ^_^")  # Press Ctrl+F8 to toggle the breakpoint.
    test_1 = barrier(host, port)
    print("ouverture des barrier...")
    test_1.open_1()
    test_1.open_2()
    time.sleep(5)
    print("fermeture des barrier...")
    test_1.close_1()
    test_1.close_2()


def ping_():
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.settimeout(timeout_seconds)
    result = sock.connect_ex((host, int(port)))
    if result == 0:
        print("Host: {}, Port: {}, Status: True".format(host, port))
        sock.close()
    else:
        print("Host: {}, Port: {}, Status: False".format(host, port))
        sock.close()


# Press the green button in the gutter to run the script.
if __name__ == '__main__':
    print_hi()

"""
# See PyCharm help at https://www.jetbrains.com/help/pycharm/

import socket

UDP_IP = "172.16.151.121"
UDP_PORT = 8888
port = 4023
serv_ip = "213.245.30.14"
serv_port = 80
up_b1 = b"11"
up_b2 = b"21"
down_b1 = b"10"
down_b2 = b"20"


def main():
    global UDP_IP, UDP_PORT, up_b1, up_b2, down_b1, down_b2
    barr_send(UDP_IP, UDP_PORT, up_b2)


def barr_send(HOST, PORT, MESSAGE):
    print("UDP target IP: %s" % UDP_IP)
    print("UDP target port: %s" % UDP_PORT)
    print("message: %s" % MESSAGE)
    sock = socket.socket(socket.AF_INET, # Internet
                     socket.SOCK_DGRAM) # UDP
    sock.sendto(MESSAGE, (HOST, PORT))


def barr_ping(host, port):
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.settimeout(5)
    result = sock.connect_ex((host, int(port)))
    if result == 0:
        print("Host: {}, Port: {}, Status: True".format(host, port))
        sock.close()
    else:
        print("Host: {}, Port: {}, Status: False".format(host, port))
        sock.close()


if __name__ == "__main__":
    main()

import socket

UDP_IP = "172.16.151.121"
UDP_PORT = 8888
MESSAGE = b"11"

print("UDP target IP: %s" % UDP_IP)
print("UDP target port: %s" % UDP_PORT)
print("message: %s" % MESSAGE)

sock = socket.socket(socket.AF_INET, # Internet
                     socket.SOCK_DGRAM) # UDP
sock.sendto(MESSAGE, (UDP_IP, UDP_PORT))
"""