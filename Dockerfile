FROM ubuntu:18.04 
MAINTAINER Seshan Ravikumar <seshan10@me.com>

ENV container docker
ENV DEBIAN_FRONTEND noninteractive

ENV VIRTUAL_HOST connectus.today,www.connectus.today
ENV LETSENCRYPT_HOST connectus.today
ENV LETSENCRYPT_EMAIL admin@connectus.today

# Prepare systemd
RUN find /etc/systemd/system \
    /lib/systemd/system \
    -path '*.wants/*' \
    -not -name '*journald*' \
    -not -name '*systemd-tmpfiles*' \
    -not -name '*systemd-user-sessions*' \
    -exec rm \{} \;

# Update Ubuntu
RUN apt-get update
RUN apt-get -y upgrade

# Install systemd & dependancies
RUN apt-get -y install dbus systemd

# Configure systemd
RUN systemctl set-default multi-user.target
RUN systemctl mask dev-hugepages.mount sys-fs-fuse-connections.mount

# Copy systemd setup file

COPY setup /sbin/

STOPSIGNAL SIGRTMIN+3

# Install Apache and PHP
RUN apt-get -y install apache2 php libapache2-mod-php

# Configure Apache/PHP
RUN mv /var/www/html/index.html /var/www/html/apache.html
# For development ONLY:
RUN sed -i -e 's/display_errors = Off/display_errors = On/g' /etc/php/7.2/apache2/php.ini

# Enable apache2
RUN systemctl enable apache2

# Copy ConnectUS frontend into container
COPY . /var/www/html

# Auto-expose port 80
EXPOSE 80

# Start container (call systemd)
CMD ["/bin/bash", "-c", "exec /sbin/init --log-target=journal 3>&1"]
