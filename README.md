# CRUD - CodeIgniter 4

## Clone

```bash
git clone git@github.com:johnata/ci4-crud.git
```

## .env

```bash
cp env .env
```

Configure your database in .env, e.g.:

```
database.default.hostname = localhost
database.default.database = ci4-crud
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

## Composer

```bash
composer install
```

## Migrate

```bash
php spark migrate
```

## Seed

```bash
php spark db:seed FakeUserSeeder
```

## Server

```bash
php spark serve
```

### Expected result

```bash
CodeIgniter v4.6.0 Command Line Tool - Server Time: 2025-04-09 12:58:04 UTC+00:00

CodeIgniter development server started on http://localhost:8080
```
