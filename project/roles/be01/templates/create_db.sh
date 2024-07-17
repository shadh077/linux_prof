#!/bin/bash

DB="wpdb"
USER="wpuser"
PASS="password"

mysql -uroot -e "CREATE DATABASE $DB";
mysql -uroot -e "CREATE USER $USER@'127.0.0.1' IDENTIFIED BY '$PASS'";
mysql -uroot -e "GRANT ALL PRIVILEGES ON $DB.* TO $USER@'127.0.0.1'";
mysql -uroot -e "FLUSH PRIVILEGES";

