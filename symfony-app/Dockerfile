FROM php:8.2.22-fpm-bookworm
RUN groupadd app --gid 1000 && \
    useradd --gid 1000 --uid 1000 --create-home app && \
    mkdir /home/app/app && \
    chown 1000:1000 /home/app/app && \
    pecl install redis-5.3.7 && \
    docker-php-ext-enable redis
RUN echo 'if [[ -d "$HOME/app/bin" ]]; then \n\
     export PATH="$HOME/app/bin:$PATH" \n\
   fi' >> /home/app/.bashrc
USER app
WORKDIR /home/app/app