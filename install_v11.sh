#!/bin/bash

#Set variables
EXT_IP="185.20.218.14"
LOCAL_NET="10.0.0.0/255.255.0.0"
MYSQL="/usr/bin/mysql"
MYSQLDUMP="/usr/bin/mysqldump"
USER="asterisk"
USER_FG="filegator"
SERVER="localhost"
DB="asterisk"
SQLDIR="/var/www/telrex/sql"

MySQL_ROOT_PASSWD="v1ter3force21"
MySQL_USER_PASSWD="s266Q48OG488g4I"
MySQL_USER_FG_PASSWD="04d1f7ae0e925eec6259332ea5c6e410"
PHP_AGI_PASSWD="FJdY6GnYtd33Nc2"

#Install Tel-REX web interface
#tar -xvf telrex.tar.gz
#mkdir /var/www/telrex
cp -r telrex/* /var/www/telrex/
#rm -rf telrex

#Change passwords
sed -i 's/v1ter321/'$MySQL_USER_PASSWD'/g' /var/www/telrex/includes/constants.php
sed -i 's/bora123wind/'$PHP_AGI_PASSWD'/g' /var/www/telrex/includes/constants.php
sed -i 's/04d1f7ae0e925eec6259332ea5c6e410/'$MySQL_USER_FG_PASSWD'/g' /var/www/telrex/filegator/configuration.php
sed -i 's/filegator/'$USER_FG'/g' /var/www/telrex/filegator/configuration.php
sed -i 's/s266Q48OG488g4I/'$MySQL_USER_PASSWD'/g' /var/www/telrex/php/lib/config.php

#Install Asterisk
adduser --group --disabled-password --no-create-home --home /var/lib/asterisk --gecos "Asterisk User" asterisk
useradd -d /var/lib/asterisk -g asterisk asterisk

tar -xvf asterisk-11-current.tar.gz
cd asterisk-11.6.0
make clean && make distclean
./configure
make menuselect.makeopts
menuselect/menuselect --enable EXTRA-SOUNDS-EN-WAV menuselect.makeopts
menuselect/menuselect --enable CORE-SOUNDS-RU-GSM menuselect.makeopts
menuselect/menuselect --enable app_mysql --enable cdr_mysql --enable res_config_mysql menuselect.makeopts
contrib/scripts/get_mp3_source.sh
make && make install
make samples
make config
make install-logrotate
cd ..
rm -rf asterisk-11.6.0

#Edit /etc/init.d/asterisk to run Asterisk as asterisk user
cp /etc/asterisk/asterisk.conf /etc/asterisk/copy.asterisk.conf
sed '65a\runuser = asterisk' /etc/asterisk/copy.asterisk.conf > /etc/asterisk/asterisk.conf
cp /etc/asterisk/asterisk.conf /etc/asterisk/copy.asterisk.conf
sed '66a\rungroup = asterisk' /etc/asterisk/copy.asterisk.conf > /etc/asterisk/asterisk.conf

#Run Apache as asterisk user
##sed -i 's/upload_max_filesize = 20M/upload_max_filesize = 200M/g' /etc/php5/apache2/php.ini
sed -i 's/\(^upload_max_filesize = \).*/\200M/' /etc/php5/apache2/php.ini
sed -i 's/\(^post_max_size = \).*/\200M/' /etc/php5/apache2/php.ini
cp /etc/apache2/apache2.conf /etc/apache2/apache2.conf_orig
sed -i 's/^\(User\|Group\).*/\1 asterisk/' /etc/apache2/apache2.conf
a2dismod autoindex
service apache2 restart
mkdir /var/www/telrex
echo -e "<?php phpinfo(); ?>" > /var/www/telrex/testphp.php


##Create Asterisk DB
$MYSQL -u root -p$MySQL_ROOT_PASSWD -Bse 'CREATE DATABASE IF NOT EXISTS '$DB''
$MYSQL -u root -p$MySQL_ROOT_PASSWD -Bse 'GRANT ALL ON '$DB'.* TO '$USER'@localhost IDENTIFIED BY "'$MySQL_USER_PASSWD'";'
$MYSQL -u root -p$MySQL_ROOT_PASSWD -Bse 'GRANT ALL ON '$DB'.* TO '$USER_FG'@localhost IDENTIFIED BY "'$MySQL_USER_FG_PASSWD'";'
$MYSQL -u $USER -h $SERVER -p$MySQL_USER_PASSWD $DB < $SQLDIR/asterisk.sql
#$MYSQL -u $USER -h $SERVER -p$MySQL_USER_PASSWD -D $DB < $SQLDIR/table.sipfriends.sql
#$MYSQL -u $USER -h $SERVER -p$MySQL_USER_PASSWD -Bse 'use '$DB'; show tables'
#$MYSQL -u $USER_FG -h $SERVER -p$MySQL_USER_FG_PASSWD -Bse 'use '$DB'; show tables'


#Configure Asterisk Realtime
mv /etc/asterisk/extensions.conf /etc/asterisk/copy.extensions.conf
mv /etc/asterisk/sip.conf /etc/asterisk/copy.sip.conf
mv /etc/asterisk/extensions.ael /etc/asterisk/copy.extensions.ael
touch /etc/asterisk/extensions.conf
touch /etc/asterisk/sip.conf
touch /etc/asterisk/extensions.ael

sed -i 's/;cachertclasses=yes/cachertclasses=yes/' musiconhold.conf

cat <<EOF > /etc/asterisk/sip.conf
[general]
context=default
rtcachefriends=yes
rtsavesysname=yes
rtupdate=yes
rtautoclear=yes
nat=force_rport,comedia
localnet=$LOCAL_NET
externaddr=$EXT_IP
language=ru
allowguest=no
alwaysauthreject=yes
disallow=all
allow=alaw
allow=ulaw
allow=ilbc
EOF

cat <<EOF > /etc/asterisk/extensions.conf
[general]
[default]
switch => Realtime/@
;switch => Realtime/default@extensions
[globals]
IVR_SOUND=/var/spool/asterisk/sounds
[user-office]
switch => Realtime/@
include => office
include => ivr
[user-inter]
switch => Realtime/@
include => international
include => office
include => ivr

[ivr]
switch => Realtime/@
[office]
switch => Realtime/@
[international]
switch => Realtime/@
EOF

cp /etc/asterisk/extconfig.conf /etc/asterisk/copy.extconfig.conf
cat <<EOF >> /etc/asterisk/extconfig.conf
sipusers => mysql,general,sipfriends
sippeers => mysql,general,sipfriends
extensions => mysql,general,extensions
voicemail => mysql,general,voicemails
queues => mysql,general,queues
queue_members => mysql,general,queue_members
meetme => mysql,general,meetme
musiconhold => mysql,general,musiconhold
queue_log => mysql,general,queue_log
EOF

cp /etc/asterisk/res_config_mysql.conf /etc/asterisk/copy.res_config_mysql.conf
cat <<EOF >> /etc/asterisk/res_config_mysql.conf
dbhost = 127.0.0.1
dbname = $DB
dbuser = $USER
dbpass = $MySQL_USER_PASSWD
dbport = 3306
dbsock = /tmp/mysql.sock
dbcharset = latin1
requirements=warn
EOF


cp /etc/asterisk/manager.conf /etc/asterisk/copy.manager.conf
cat <<EOF > /etc/asterisk/manager.conf
; Asterisk Call Management support
; By default asterisk will listen on localhost only. 
;
[general]
enabled = yes
port = 5038
bindaddr = 127.0.0.1
webenabled = no

; Each user has a section labeled with the username
[phpagi]
secret = $PHP_AGI_PASSWD
deny=0.0.0.0/0.0.0.0
permit=127.0.0.1/255.255.255.0
read = system,call,log,verbose,command,agent,user,originate
write = system,call,log,verbose,command,agent,user,originate
EOF

cp /etc/asterisk/cdr_mysql.conf /etc/asterisk/copy.cdr_mysql.conf
cat <<EOF > /etc/asterisk/cdr_mysql.conf
[global]
hostname=127.0.0.1
dbname=asterisk
table=cdr
password=$MySQL_USER_PASSWD 
user=asterisk
port=3306
sock=/tmp/mysql.sock
;timezone=UTC ; Previously called usegmtime
;
; You may also configure the field names used in the CDR table.
;
[columns]
;static "<value>" => <column>
;alias <cdrvar> => <column>
alias start => calldate
;alias clid => <a_field_not_named_clid>
;alias src => <a_field_not_named_src>
;alias dst => <a_field_not_named_dst>
;alias dcontext => <a_field_not_named_dcontext>
;alias channel => <a_field_not_named_channel>
;alias dstchannel => <a_field_not_named_dstchannel>
;alias lastapp => <a_field_not_named_lastapp>
;alias lastdata => <a_field_not_named_lastdata>
;alias duration => <a_field_not_named_duration>
;alias billsec => <a_field_not_named_billsec>
;alias disposition => <a_field_not_named_disposition>
;alias amaflags => <a_field_not_named_amaflags>
;alias accountcode => <a_field_not_named_accountcode>
;alias userfield => <a_field_not_named_userfield>
;alias uniqueid => <a_field_not_named_uniqueid>
EOF

cp /etc/asterisk/modules.conf /etc/asterisk/modules.conf.copy
cat <<EOF >> /etc/asterisk/modules.conf
noload => chan_skinny.so
EOF

##Sounds
#cp asterisk-extra-sounds-en-gsm-current.tar.gz /var/lib/asterisk/sounds/
#cp asterisk-core-sounds-ru-alaw-current.tar.gz /var/lib/asterisk/sounds/
#cd /var/lib/asterisk/sounds
#tar -xvf asterisk-core-sounds-ru-alaw-current.tar.gz
#tar -xvf asterisk-extra-sounds-en-gsm-current.tar.gz
#rm asterisk-extra-sounds-en-gsm-current.tar.gz
#rm asterisk-core-sounds-ru-alaw-current.tar.gz
#cd /home/superadmin/telrex/
#MOH
sed -i 's/directory=moh/directory=\/var\/spool\/asterisk\/moh/' musiconhold.conf
mkdir /var/spool/asterisk/moh
cp /var/lib/asterisk/moh/* /var/spool/asterisk/moh/
#IVR Uploaded Sounds 
mkdir /var/spool/asterisk/sounds

# Security
# iptables and Fail2Ban IPS for Asterisk
cp /etc/asterisk/logger.conf /etc/asterisk/copy.logger.conf
sed -i 's/messages => notice,warning,error/messages => security,notice,warning,error/g' /etc/asterisk/logger.conf
cp iptables.up.rules /etc/
iptables-restore < /etc/iptables.up.rules
touch /etc/network/if-pre-up.d/iptables
echo '#!/bin/bash' > /etc/network/if-pre-up.d/iptables
echo '/sbin/iptables-restore < /etc/iptables.up.rules' >> /etc/network/if-pre-up.d/iptables
chmod +x /etc/network/if-pre-up.d/iptables

apt-get -y install fail2ban
cat <<EOF > /etc/fail2ban/filter.d/asterisk.conf
# Fail2Ban configuration file
# Author: Xavier Devlamynck
 
[INCLUDES]
 
# Read common prefixes. If any customizations available -- read them from
# common.local
before = common.conf
 
[Definition]
 
# Option:  failregex
# Notes.:  regex to match the password failures messages in the logfile.
# Values:  TEXT
#
log_prefix= \[\]\s*(?:NOTICE|SECURITY)%(__pid_re)s:?(?:\[\S+\d*\])? \S+:\d*
 
failregex = ^%(log_prefix)s Registration from '[^']*' failed for '<HOST>(:\d+)?' - Wrong password$
            ^%(log_prefix)s Registration from '[^']*' failed for '<HOST>(:\d+)?' - No matching peer found$
            ^%(log_prefix)s Registration from '[^']*' failed for '<HOST>(:\d+)?' - Username/auth name mismatch$
            ^%(log_prefix)s Registration from '[^']*' failed for '<HOST>(:\d+)?' - Device does not match ACL$
            ^%(log_prefix)s Registration from '[^']*' failed for '<HOST>(:\d+)?' - Peer is not supposed to register$
            ^%(log_prefix)s Registration from '[^']*' failed for '<HOST>(:\d+)?' - ACL error \(permit/deny\)$
            ^%(log_prefix)s Registration from '[^']*' failed for '<HOST>(:\d+)?' - Not a local domain$
            ^%(log_prefix)s Call from '[^']*' \(<HOST>:\d+\) to extension '\d+' rejected because extension not found in context 'default'\.$
            ^%(log_prefix)s Host <HOST> failed to authenticate as '[^']*'$
            ^%(log_prefix)s No registration for peer '[^']*' \(from <HOST>\)$
            ^%(log_prefix)s Host <HOST> failed MD5 authentication for '[^']*' \([^)]+\)$
            ^%(log_prefix)s Failed to authenticate (user|device) [^@]+@<HOST>\S*$
            ^%(log_prefix)s (?:handle_request_subscribe: )?Sending fake auth rejection for (device|user) \d*<sip:[^@]+@<HOST>>;tag=\w+\S*$
            ^%(log_prefix)s SecurityEvent="(FailedACL|InvalidAccountID|ChallengeResponseFailed|InvalidPassword)",EventTV="[\d-]+",Severity="[\w]+",Service="[\w]+",EventVersion="\d+",AccountID="\d+",SessionID="0x[\da-f]+",LocalAddress="I$
 
# Option:  ignoreregex
# Notes.:  regex to ignore. If this regex matches, the line is ignored.
# Values:  TEXT
#
ignoreregex =
EOF

echo <<EOF >> /etc/fail2ban/jail.conf
[asterisk-tcp]
enabled  = true
port  = 5060
filter   = asterisk
#action   = iptables-allports[name=ASTERISK, protocol=all]
action   = iptables-multiport[name=asterisk-tcp, port="5060,5061", protocol=tcp]
           sendmail-whois[name=ASTERISK, dest=bondarenko@techexpert.ua, sender=root]
logpath  = /var/log/asterisk/messages
#logpath  = /var/log/asterisk/security
maxretry = 8
findtime = 21600
bantime = 259200

[asterisk-udp]
enabled  = true
port  = 5060
filter   = asterisk
#action   = iptables-allports[name=ASTERISK, protocol=all]
action   = iptables-multiport[name=asterisk-udp, port="5060,5061", protocol=udp]
           sendmail-whois[name=ASTERISK, dest=bondarenko@techexpert.ua, sender=root]
logpath  = /var/log/asterisk/messages
#logpath  = /var/log/asterisk/security
maxretry = 8
findtime = 21600
bantime = 259200
EOF
/etc/init.d/fail2ban restart

##Change rights
chown -R asterisk. /etc/asterisk
chown -R asterisk. /run/asterisk
chown -R asterisk. /var/{lib,log,spool,run}/asterisk
chown -R asterisk. /usr/{lib,sbin,include}/asterisk
chown -R asterisk. /var/www/
chown -R asterisk. /etc/logrotate.d/asterisk
#chmod -R 644 /etc/asterisk

#Reboot Asterisk
/etc/init.d/asterisk stop
sleep 3
/etc/init.d/asterisk start
sleep 2
iptables-restore < /etc/iptables.up.rules
/etc/init.d/fail2ban restart

#Enable SSL for WEB interface
mkdir -p /etc/ssl/localcerts
openssl req -new -x509 -days 365 -nodes -subj "/C=UA/ST=Kiev/L=Kiev/O=Kiev/CN=www.techexpert.ua" -out /etc/ssl/localcerts/apache.pem -keyout /etc/ssl/localcerts/apache.key
chmod 600 /etc/ssl/localcerts/apache*
a2enmod ssl
service apache2 restart
cp tel-rex /etc/apache2/sites-available/
a2ensite tel-rex	
a2enmod rewrite   #Redirect http request to https
cp 000-default /etc/apache2/sites-enabled/000-default
service apache2 reload

#Install Festival
apt-get -y install festvox-ru
cp /usr/share/doc/festival/examples/festival.init /etc/init.d/festival
chmod +x /etc/init.d/festival
echo 'RUN_FESTIVAL=yes' > /etc/default/festival
cp festival.scm /etc/
/etc/init.d/festival restart

