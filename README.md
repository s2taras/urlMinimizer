


#### Build containers:
```
docker-compose build
```

#### Up containers:
```
docker-compose up
```

#### Stop containers:
```
docker-compose stop
```

#### Install composer
````
composer install --no-interaction --optimize-autoloader
````

#### Run migrations inside APP container
````
php yii migrate/up --interactive=0
````

#### Hosts for dev environment
````
127.0.0.1	test.local  
````

#### Local websites
http://test.local:8080