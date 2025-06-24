# base image ubuntu
FROM ubuntu:22.04

ENV OS_LOCALE="en_US.UTF-8"
ENV DEBIAN_FRONTEND=noninteractive \
    COMPOSER_ALLOW_SUPERUSER=1 \
    LANG=${OS_LOCALE} \
    LANGUAGE=${OS_LOCALE} \
    LC_ALL=${OS_LOCALE}

# set locale
RUN apt-get update && apt-get install -y locales && locale-gen ${OS_LOCALE}

# update & upgrade
RUN apt-get update -y && apt-get upgrade -y

# install tools & PHP repo
RUN apt-get install -y software-properties-common ca-certificates lsb-release apt-transport-https curl unzip git \
    && add-apt-repository ppa:ondrej/php -y

# install PHP 8.3 & Apache + extensions
RUN apt-get update -y && apt install -y \
    php8.3 php8.3-cli php8.3-common php8.3-curl php8.3-apcu php8.3-dev php-pear \
    php8.3-pdo php8.3-mysql php8.3-mbstring php8.3-opcache php8.3-readline php8.3-xml \
    php8.3-zip php8.3-bcmath php8.3-gd php8.3-intl php8.3-soap php8.3-sqlite3 \
    libapache2-mod-php8.3 gettext-base supervisor

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer clear-cache

# konfigurasi PHP custom
RUN echo "memory_limit=512M" >> /etc/php/8.3/apache2/conf.d/99-custom.ini \
    && echo "upload_max_filesize=500M" >> /etc/php/8.3/apache2/conf.d/99-custom.ini \
    && echo "post_max_size=500M" >> /etc/php/8.3/apache2/conf.d/99-custom.ini \
    && echo "max_execution_time=600" >> /etc/php/8.3/apache2/conf.d/99-custom.ini \
    && echo "allow_url_fopen=On" >> /etc/php/8.3/apache2/conf.d/99-custom.ini \
    && echo "error_reporting=E_ALL & ~E_NOTICE" >> /etc/php/8.3/apache2/conf.d/99-custom.ini

# aktifkan mod rewrite apache
RUN a2enmod rewrite

# bersih-bersih
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* ~/.composer \
    && rm -f /var/www/html/index.html

# salin konfigurasi apache & supervisor
COPY .conf/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY .conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# direktori kerja
WORKDIR /var/www/html

# buka port apache
EXPOSE 80

# perintah default
CMD ["/usr/bin/supervisord"]