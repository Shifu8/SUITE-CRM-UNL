# ============================================================
#  SuiteCRM UNL – Dockerfile
#  Base: PHP 8.1 + Apache (imagen oficial de PHP)
#  Compatible con SuiteCRM 8.x
# ============================================================

FROM php:8.1-apache

# ------------------------------------
# Dependencias del sistema operativo
# ------------------------------------
RUN apt-get update && apt-get install -y --no-install-recommends \
    # Librerías para extensiones PHP
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libicu-dev \
    libldap2-dev \
    # Herramientas de sistema
    unzip \
    zip \
    git \
    curl \
    default-mysql-client \
    cron \
    && rm -rf /var/lib/apt/lists/*

# ------------------------------------
# Extensiones PHP requeridas por SuiteCRM
# ------------------------------------
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mysqli \
        gd \
        zip \
        xml \
        mbstring \
        curl \
        intl \
        opcache \
        bcmath \
        soap \
        ldap \
        exif \
        calendar \
        sockets

# Habilitar mod_rewrite de Apache (requerido por SuiteCRM)
RUN a2enmod rewrite headers expires deflate

# ------------------------------------
# Configuración de PHP
# ------------------------------------
COPY docker/php/suitecrm.ini /usr/local/etc/php/conf.d/suitecrm.ini

# ------------------------------------
# Configuración de Apache VirtualHost
# ------------------------------------
COPY docker/apache/suitecrm.conf /etc/apache2/sites-available/000-default.conf

# ------------------------------------
# Código fuente de SuiteCRM
# ------------------------------------
WORKDIR /var/www/html

# Copiar todo el código (respetando .dockerignore)
COPY . .

# Permisos correctos para SuiteCRM
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type f -name "*.php" -exec chmod 644 {} \; \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && chmod -R 775 \
        /var/www/html/public/legacy/cache \
        /var/www/html/public/legacy/custom \
        /var/www/html/public/legacy/modules \
        /var/www/html/public/legacy/upload \
        /var/www/html/logs \
        /var/www/html/tmp \
    && chmod 775 /var/www/html/public/legacy/config.php 2>/dev/null || true \
    && chmod 775 /var/www/html/public/legacy/config_override.php 2>/dev/null || true

# ------------------------------------
# Script de inicio
# ------------------------------------
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
