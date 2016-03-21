# LAMP-Oauth

This project is the LAMP version of project [OAuth 2.0 Servers](https://github.com/wyushi/oauth2-servers).

It is used [Slim 3](http://www.slimframework.com/) micro framework to build the PHP project structure.

And It is use [OAuth 2.0 Server PHP](http://bshaffer.github.io/oauth2-server-php-docs/) to handle OAuth 2.0 features. 

## Setup

### LAMP

Build Image
```
docker build -t your_lamp_image .
```

Run container
```
docker run -p 3000:80 -p 4000:8080 -v $(pwd):/var/www/example.com -it your_lamp_image /bin/bash
```

Base Image: [linode/lamp](https://hub.docker.com/r/linode/lamp/)

For More LAMP settings, check [docker](https://hub.docker.com/r/linode/lamp/)

### MySQL
* Example database: **exampleDB**
* Example user: **example_user**
* Example user password: **Admin2015**

### Composer & Dependencies

Download [Composer docker image](https://hub.docker.com/r/composer/composer/)
```
docker pull composer/composer
```

Install Dependencies (vendor)
```
docker run --rm -v $(pwd):/app composer/composer install
```

\*Update Dependencies

```
docker run --rm -v $(pwd):/app composer/composer update
```
