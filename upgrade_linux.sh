#!/bin/bash

#Upgrading Linux
###############
apt-get -y update && apt-get -y upgrade
apt-get -y install ntp


#Only for Debian 7
apt-get -y install build-essential linux-headers-`uname -r` openssh-server apache2 mysql-server mysql-client libgnutls-dev bison flex php5 php5-curl php5-cli php5-mysql php-pear php-db php5-gd curl sox libncurses5-dev libssl-dev libmysqlclient-dev mpg123 libxml2-dev libnewt-dev sqlite3 libsqlite3-dev pkg-config automake libtool autoconf git subversion
pear install db
#End

cat <<EOF > ~/.screenrc 
use visual bell
vbell on
# replace ctrl-A by ctrl-O
#escape ^Oo
# set a big scrolling buffer
defscrollback 5000
# Set the caption on the bottom line
caption always "%{= kw}%-w%{= BW}%n %t%{-}%+w %-= @%H - %LD %d %LM - %c"
EOF

apt-get -y install ntp
/etc/init.d/ntp restart

#secure mysql
mysql_secure_installation

#then reboot

