_autorun_rc() {
    a2ensite phpmyadmin.conf &process_id=$!
	wait $!
    cp -f config/rc.local /etc/apache2/sites-available/ &process_id=$!
	wait $!
    echo "Installation de RC.local..."
}

_autorun_rc()