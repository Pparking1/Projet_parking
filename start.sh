#!/bin/bash
RTSP_Prox() {
	nodejs RTSP_proxy/relay.js
	echo "RTSP proxy is listening ::2000"
	nodejs RTSP_proxy/relay_2.js
	echo "RTSP proxy is listening ::2001"
}

parking_main() {
	python3 /home/openalpr/setup/1_python_openalpr/main.py
}

RTSP_proxy() > log_proxy.log | parking_main()
