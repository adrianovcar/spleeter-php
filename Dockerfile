FROM php:7.4-apache
LABEL maintainer="Adriano Carrijo <@adrianovc>"

# 01. Install some dependencies
RUN apt update && \
    apt install \
    git \
    wget \
    -y

# 02. Copy php.ini file
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# 03. Enable PHP extensions
RUN apt-get update && \
    apt-get install -y \
    python3.4 \
    python3-pip \
    libsndfile1 \
    ffmpeg

# 04. Clean cache
RUN rm -rf /var/lib/apt/lists/*

# 05. Install Deezer Spleeter
RUN pip install spleeter

# 06. Copy project files to build
COPY . /var/www/html/

# 07. Run composer
RUN wget -cO - https://getcomposer.org/composer-stable.phar > /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    composer install \
    --no-dev \
    --prefer-dist \
    --no-scripts \
    --ignore-platform-reqs \
    --no-progress \
    --optimize-autoloader \
    --no-interaction
