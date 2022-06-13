import socket, csv, json

hosts = './hosts.txt'
ports = './ports.txt'
timeout_seconds = 1

with open(hosts, 'r') as filehosts:
    for host in filehosts:

        host = host.rstrip("\n")
        with open(ports, 'r') as fileports:
            for port in fileports:
                port = port.rstrip("\n")
                sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
                sock.settimeout(timeout_seconds)
                result = sock.connect_ex((host, int(port)))
                if result == 0:
                    print("Host: {}, Port: {}, Status: True".format(host, port))
                    sock.close()
                else:
                    print("Host: {}, Port: {}, Status: False".format(host, port))
                    sock.close()