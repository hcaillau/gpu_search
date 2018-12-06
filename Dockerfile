ARG docker_registry=registry.sai-experimental.ign.fr
FROM ${docker_registry}/ign/php:5.6

ENV no_proxy=elasticsearch,${no_proxy}

RUN apt-get update \
 && apt-get install -y wget \
 && php-install-ext.sh xdebug \
 && rm -rf /var/lib/apt/lists/*

#-------------------------------------------------------------------------------
# install gpu-search
#-------------------------------------------------------------------------------
COPY --chown=www-data . /application
COPY --chown=www-data docker/parameters.yml /application/app/config/parameters.yml
RUN chmod +x /application/docker/*.sh

#-------------------------------------------------------------------------------
# configure apache
#-------------------------------------------------------------------------------
COPY docker/apache/application.conf /etc/apache2/sites-available/application.conf
RUN a2enmod rewrite \
 && a2dissite 000-default.conf && a2ensite application.conf

RUN usermod -s /bin/bash -d /application www-data

WORKDIR /application
CMD ["/application/docker/application.sh"]

