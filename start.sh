#!/bin/bash

source start-utils

host=$(hostname)
line=$(cat /etc/hosts |grep [1]27.0.0.1)
echo "$line noreply@gresso.ru $host" >> /etc/hosts

echo "$host" >> /etc/mail/relay-domains
m4 /etc/mail/sendmail.mc > /etc/mail/sendmail.cf

# Всё запускаем
nginx & sendmail -bd
service php7.1-fpm start
# Ждём SIGTERM или SIGINT
wait_signal



# Запрашиваем остановку
nginx stop
service sendmail stop
service php7.1-fpm stop

# Ждём завершения процессов по их названию
wait_exit "nginx sendmail php7.1-fpm"
