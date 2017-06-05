FROM php:7.0-apache


# Install developer dependencies
RUN apt-get update -yqq && apt-get install -y git libxslt-dev libsqlite3-dev libsqlite3-0 libxml2-dev libicu-dev libfreetype6-dev libmcrypt-dev libjpeg62-turbo-dev libpng12-dev git libcurl4-gnutls-dev libbz2-dev libssl-dev -yqq

# Install php extensions
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install pdo_sqlite
RUN docker-php-ext-install opcache
RUN docker-php-ext-install json
RUN docker-php-ext-install calendar
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install xml
RUN docker-php-ext-install zip
RUN docker-php-ext-install xsl
RUN docker-php-ext-install bz2
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install mcrypt
RUN docker-php-ext-install curl

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd

# Install PECL extensions
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

#RUN pecl install phar
RUN docker-php-ext-install phar

#RUN pecl install intl
RUN docker-php-ext-install intl

RUN a2enmod  rewrite \
    && a2enmod deflate \
    && a2enmod headers \
    && a2ensite 000-default.conf

# Install composer and put binary into $PATH
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer


RUN apt-get -y install nodejs
RUN apt-get -y install npm

RUN ln -s `which nodejs` /usr/bin/node

RUN echo 'post_max_size = 200M' >> 	/usr/local/etc/php/php.ini
RUN echo 'upload_max_filesize =  200M' >> 	/usr/local/etc/php/php.ini
RUN echo 'date.timezone = "Europe/Warsaw"' >> 	/usr/local/etc/php/php.ini

COPY ./000-default.conf /etc/apache2/sites-enabled/000-default.conf



COPY ./keys/.ssh/id_rsa /root/.ssh/id_rsa
RUN chmod 700 /root/.ssh/id_rsa
RUN echo "Host bitbucket.org\n\tStrictHostKeyChecking no\n" >> /root/.ssh/config

RUN eval `ssh-agent -s` && \
    ssh-add /root/.ssh/id_rsa

ENV TERM=xterm \
TZ=Europe/Berlin

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]