# LAMP-Oauth

##Setup

###Composer & Dependencies

Download composer docker
```
docker pull composer/composer
```

Run a container of composer
```
docker run --rm -v $(pwd):/app composer/composer install
```

### LAMP 

Build Image
```
docker build -t yushi/lamp .
```

Run container
```
docker run -p 3000:80 -p 4000:8080 -v $(pwd):/var/www/example.com -it yushi/lamp /bin/bash
```