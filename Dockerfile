FROM debian:jessie

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
    apt-utils \
    && apt-get install -y nginx \
    && apt-get install -y apt-transport-https lsb-release ca-certificates \
    && apt-get install -y wget \
    && wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb https://packages.sury.org/php/ jessie main" > /etc/apt/sources.list.d/php.list \
    && apt-get update -y \
    && apt-get install -y php7.1 \
    && apt install -y php7.1-fpm \
    && php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
	&& php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && apt-get install -y sendmail \
    && apt-get install -y curl \
    && apt-get install -y php7.1-curl \
    && apt-get install -y git \
	&& groupadd sshusers \
	&& useradd -d /var/www/html/obvad.ru/www -s /bin/bash -g sshusers -c obvad.ru -u 1009 obvad.ru \	
    && curl -sL https://deb.nodesource.com/setup_7.x | bash - \
    && apt-get install -y nodejs \
    && npm install -y gulpjs/gulp-cli -g \
    && rm -rf /var/lib/apt/lists/* \
    && echo "daemon off;" >> /etc/nginx/nginx.conf \
	&& rm -rf /etc/nginx/sites-available/default

RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/7.1/fpm/php.ini \
    && sed -i "s/; max_input_vars = 1000/max_input_vars = 10000/"  /etc/php/7.1/fpm/php.ini \
    && sed -i "s/memory_limit = 128M/memory_limit = 512M/"  /etc/php/7.1/fpm/php.ini \
    && sed -i "s/;pcre.recursion_limit=100000/pcre.recursion_limit=1000/"  /etc/php/7.1/fpm/php.ini \
    && sed -i "s/;mbstring.func_overload = 0/mbstring.func_overload = 2/"  /etc/php/7.1/fpm/php.ini \
    && sed -i "s/upload_max_filesize = 2M/upload_max_filesize = 8M/"  /etc/php/7.1/fpm/php.ini \
    && sed -i "$ a mbstring.internal_encoding = utf-8" /etc/php/7.1/fpm/php.ini \
    && sed -i "$ a sendmail_path = /usr/sbin/sendmail -t -i -finfo@obvad.ru"  /etc/php/7.1/fpm/php.ini \
    && sed -i "s/user = www-data/user = obvad.ru/" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "s/group = www-data/group = sshusers/" /etc/php/7.1/fpm/pool.d/www.conf 

ADD start-utils start.sh /
RUN chmod +x /start.sh
CMD [ "/start.sh" ] 
