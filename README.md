# RSS Reader

## Installation

After cloning the repository to a local directory, the following process will build the application ready for development.

The simplest method to setup the application is using the included Makefile, this requires Make as a dependency. If Make is unavailable, skip to the Manual Setup instructions below.

### Makefile

For your convenience, a Makefile is included which will handle initial setup of the application:

```
make install
```

Next, edit the newly created `.env` file and update where neccessary, such as database credentials if the included docker container is not being utilised. 

Run migrations to set up the databsae. _Note: If you receive an error `MySQL has gone away`, please wait a few seconds for the MySQL database to finish booting and then run the migration command again._
```
php artisan migrate
```

Finally, serve the application:
```
php artisan serve
```

The application will now be available on http://127.0.0.1:8000

### Manual setup

As an alternative to Make, the application can be manually setup using the steps listed below.

Install packages
```
composer install
```

Start the required docker container(s) (If you are using either a local or cloud database, this can be skipped)
```
docker-compose up -d
```

Create an env file based off the included example
```
cp .env.example .env
```

Generate an app key
```
php artisan key:generate
```

Next, edit the newly created `.env` file and update where neccessary, such as database credentials if the included docker container is not being utilised. 

After updating the `.env` file, build the database using the included migrations. _Note: If you receive an error `MySQL has gone away`, please wait a few seconds for the MySQL database to finish booting and then run the migration command again._ 
```
php artisan migrate
```

Build the frontend assets
```
npm install && npm run dev
```

Finally, serve the application
```
php artisan serve
```

The application will now be available on http://127.0.0.1:8000

### Requirements 

- Docker
- PHP 7+
- Composer
- NPM
- Make (optional step)
