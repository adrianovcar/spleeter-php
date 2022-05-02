FROM php:7.4-apache
LABEL maintainer="Adriano Carrijo <@adrianovc>"

# 01. Install dependencies
RUN apt-get update && \
    apt-get install -y \
    python3.4 \
    python3-pip \
    libsndfile1 \
    ffmpeg

# 02. Copy php.ini file
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# 03. Clean cache
RUN rm -rf /var/lib/apt/lists/*

# 04. Install Deezer Spleeter
RUN pip install spleeter

# 05. Add user for application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# 06. Copy project files to build
COPY . /var/www/html/

# 07. Copy existing application directory permissions
COPY --chown=www:www . /var/www/html

# 08. Change current user to www
USER www
