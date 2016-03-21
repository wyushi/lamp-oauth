# LAMP-Oauth

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
