import socket

def calcul_checksum(message):
    cs = 0
    for i in message:
        cs = cs ^ ord(i)
    return cs

def sent_ms(HOST, PORT, message, color='blue'):
    client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    client.connect((HOST, PORT))
    if color == 'red':
        hex_color = '<CC>'
    if color == 'green':
        hex_color = '<CF>'
    print('Connexion vers ' + str(HOST) + ':' + str(PORT) + ' reussie.')
    # cf    ci  cc
    Trame = '<L1><PA><FE><MA><WC><FE>' + hex_color +  message
    ms = '<ID00>' + Trame + '{:02X}'.format(calcul_checksum(Trame), 'X') + '<E>'
    print('Envoi de :' + ms)
    n = client.send(ms.encode())

sent_ms('172.16.151.189', 5000, "Salut quelqu'un peut faire coucou a la camera ?", 'red')
