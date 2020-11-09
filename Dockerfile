FROM php:5.6-apache
# Install PHP extensions
RUN set -ex; \
        \
        savedAptMark="$(apt-mark showmanual)"; \
        \
        apt-get update; \
        apt-get install -y --no-install-recommends \
                libbz2-dev \
                libgmp-dev \
                libjpeg-dev \
                    libldap2-dev \
                libmcrypt-dev \
                libmemcached-dev \
                libpng-dev \
                libpq-dev \
                libzip-dev \
        ; \
        ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h; \
        \
        docker-php-ext-configure gd --with-jpeg; \
        debMultiarch="$(dpkg-architecture --query DEB_BUILD_MULTIARCH)"; \
        docker-php-ext-configure ldap --with-libdir="lib/$debMultiarch"; \
        docker-php-ext-install -j "$(nproc)" \
                bz2 \
                gd \
                gmp \
                ldap \
                mysqli \
                pdo_mysql \
                pdo_pgsql \
                pgsql \
                zip \
        ; 

RUN a2enmod rewrite
COPY . /var/www/html/
# SSH server
RUN apt-get install -y -q supervisor openssh-server
RUN mkdir -p /var/run/sshd

# Output supervisor config file to start openssh-server
RUN echo "[program:openssh-server]" >> /etc/supervisor/conf.d/supervisord-openssh-server.conf
RUN echo "command=/usr/sbin/sshd -D" >> /etc/supervisor/conf.d/supervisord-openssh-server.conf
RUN echo "numprocs=1" >> /etc/supervisor/conf.d/supervisord-openssh-server.conf
RUN echo "autostart=true" >> /etc/supervisor/conf.d/supervisord-openssh-server.conf
RUN echo "autorestart=true" >> /etc/supervisor/conf.d/supervisord-openssh-server.conf

# Allow root login via password
# root password is: root
RUN sed -ri 's/PermitRootLogin without-password/PermitRootLogin yes/g' /etc/ssh/sshd_config

# Set root password
# password hash generated using this command: openssl passwd -1 -salt xampp root
RUN sed -ri 's/root\:\*/root\:\$1\$xampp\$5\/7SXMYAMmS68bAy94B5f\./g' /etc/shadow

# Few handy utilities which are nice to have
RUN apt-get -y install nano vim less --no-install-recommends

RUN apt-get clean

EXPOSE 3306
EXPOSE 22
EXPOSE 80

