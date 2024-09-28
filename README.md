# ApexDMIT Backend Task (API & Admin panel)

### APPLICATION RUNNING PROCESS:
    1.USING DOCKER COMPOSE
    2.NORMAL LARAVEL RUN
### REQUIREMENTS
- **[PHP](https://www.php.net/)** >= 8.2 **OR** **[Docker](https://www.docker.com/)**
- **[Postman]** (you will get postman collection by click this link) Or (you will get collection from application root folder)

### INSTALLATION PROCESS BY DOCKER COMPOSE
```shell
git clone https://github.com/alamin899/backend-api-task.git
```
```shell
cd backend-api-task
```
```bash
cp .env.example .env
```

```bash
docker-compose build
```
```bash
docker-compose up -d
```

Execute application container
```bash
docker-compose run --rm api_backend_php composer update
```

```bash
docker-compose run --rm api_backend_php php artisan key:generate
```

```bash
docker-compose run --rm api_backend_php php artisan migrate:fresh --seed
```

Click to open the [application](http://localhost:8087/)

**Admin panel credentials**
```
Email: alaminhossen899@gmail.com
Password: password
```
Click to open the [admin panel](http://localhost:8087/)

Execute php container
```bash
docker exec -it api_backend_php bash
```
Execute mysql container
```bash
docker exec -it api_backend_php bash
```

### INSTALLATION PROCESS WITHOUT DOCKER COMPOSE
```shell
git clone https://github.com/alamin899/backend-api-task.git
```
```shell
cd backend-api-task
```
```bash
cp .env.example .env
   database credential update
   cache driver redis credential update
```

```bash
composer update
```

```bash
php artisan key:generate
```

```bash
php artisan migrate:fresh --seed
```

```bash
php artisan serve --port=8087
```

Click to open the [application](http://localhost:8087/)

**Admin panel credentials**
```
Email: alaminhossen899@gmail.com
Password: password
```
Click to open the [admin panel](http://localhost:8087/)
