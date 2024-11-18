# Используем официальный образ PHP с FPM
FROM php:8.2-fpm

# Устанавливаем системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libicu-dev \
    g++ \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd intl \
    && pecl install zip \
    && docker-php-ext-enable zip

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем все файлы проекта в контейнер
COPY . /var/www

# Устанавливаем права для папок storage и bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Устанавливаем зависимости Laravel с помощью Composer
RUN composer install --no-dev --optimize-autoloader

# Выполняем команды Laravel
RUN php artisan config:clear && php artisan cache:clear

# Открываем порт 9000 для PHP-FPM
EXPOSE 9000

# Запуск PHP-FPM
CMD ["php-fpm"]
