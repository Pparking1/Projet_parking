supp_frame()
encode_flux()

supp_frame() {
	sudo rm ../framee/stream.m3u8 &process_id=$!
	wait $!
	for ../frame/ in 
}
encode_flux() {
	sudo ffmpeg -v verbose  -i rtsp://172.16.151.210/streaming/channels/1 -vf scale=950:540  -vcodec libx264 -r 25 -b:v 1000 -crf 31 -acodec aac  -sc_threshold 0 -f hls  -hls_time 1  -segment_time 1 -hls_list_size 1 ../frame/stream.m3u8 &process_id=$! &$!=$encod_flux_1
	wait $!
}
echo_end() {
	red=`tput setaf 5`
	green=`tput setaf 6`
	reset=`tput sgr0`
	echo "${red}red text ${green}green text${reset}"
	echo "========================"
	echo "	 ${PINK}Process gone....${NC}     "
	echo "========================"
}
