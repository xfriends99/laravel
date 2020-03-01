# Atomic IncFile Fake Post

Artisan command to send a simple POST request to https://atomic.incfile.com/fakepost

# set-up env instructions

Env and docker files:
```commandline
cp docker-compose.example.yml docker-compose.yml
cp .env.example .env
```

Configure .env file:
```
APP_NAME=Incfile
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=incfile_postgres
DB_PORT=5432
DB_DATABASE=incfile
DB_USERNAME=incfile
DB_PASSWORD=qweasddocker
DB_SCHEMA=incfile

QUEUE_CONNECTION=beanstalkd
BEANSTALKD_HOST=incfile_beanstalkd
ATOMIC_INC_FILE_DOMAIN=https://atomic.incfile.com
SENTRY_LARAVEL_DSN={SENTRY_DSN}
```

Run docker: 
```commandline
docker network create --driver=bridge --subnet=172.19.1.0/16 incfile
docker-compose up -d
```

Install dependencies and run commands: 
```commandline
docker-compose exec app /bin/sh
composer install
php artisan key:generate
php artisan migrate
```

## Command
The command created to execute the requests is:

```
php artisan atomic-incfile:fake-post
```

## Job

The implementation of work queues was proposed with the purpose of being able to process 100k requests or more.

#### Details

**File:** `App\Jobs\AtomicIncFile\FakePostJob`

**Timeout:** `30 seconds`

**Retry after:** `30 seconds`

**Tries:** `5 times`

**Queue:** `atomic-incfile`

#### Example run command for listen

```
php artisan queue:work --queue=atomic-incfile
```

#### Failed jobs

To view all of your failed jobs, you may use the `queue:failed` artisan command:

```
php artisan queue:failed
```

The job ID may be used to retry the failed job:

```
php artisan queue:retry {id}
```

## Sentry Application Monitoring and Error Tracking Software
Sentry implementation is proposed to receive notifications of errors associated with exceptions given by requests to third-party endpoints.

#### Details

**DSN:** You must configure the dns address as explained in the environment configuration.

In the `failed` method of the job, the exception instance is received and the details that will be shown in the sentry panel are captured.