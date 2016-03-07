FROM linode/lamp

RUN echo "install vim"

RUN apt-get update && apt-get install -y vim

RUN a2enmod rewrite

COPY apache2.conf /etc/apache2/apache2.conf

WORKDIR /var/www/example.com

EXPOSE 80 8080

CMD ["service apache2 start"]