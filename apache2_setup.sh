#!/bin/bash
install_www() {
	apt-get update &process_id=$!
	wait $!
	apt install apache2 php libapache2-mod-php mariadb-server php-mysql &process_id=$!
	wait $!
	apt-get install ssh &process_id=$!
	# wait $!
	# cp -f 000-default.conf /etc/apache2/sites-available/ &process_id=$!
	wait $!
	cp -f Web/phpmyadmin.conf /etc/apache2/sites-available/ &process_id=$!
	wait $!
	cp -f Web/usr/phpmyadmin /usr/share/ &process_id=$!
	wait $!
	cp -f Web/etc/phpmyadmin /etc/ &process_id=$!
	wait $!
	cp -f Web/www /var/ &process_id=$!
	wait $!
	a2ensite phpmyadmin.conf &process_id=$!
	wait $!
	service apache2 reload &process_id=$!
	wait $!
	echo "Server Web installée..."
}

install_www()