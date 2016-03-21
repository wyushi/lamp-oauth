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

#### Apache 2

In /etc/apache2/apache2.conf (If you are using docker, this would be automatically done)
```
<Directory /var/www/>
	Options Indexes FollowSymLinks
	AllowOverride All
	Require all granted
</Directory>
```

#### MySQL
* Example database: **exampleDB**
* Example user: **example_user**
* Example user password: **Admin2015**

Build Table Schema:
```
php -f setup_db.php
```
or
```
mysql -p < db_tables
```

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
## License
(The MIT License)

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
