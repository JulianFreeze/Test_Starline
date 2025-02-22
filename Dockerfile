FROM php:8.2-cli
COPY . /usr/src/app
WORKDIR /usr/src/app

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

CMD ["php", "-S", "0.0.0.0:8000"]