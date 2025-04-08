# CRUD - CodeIgniter 4

## Clone

```bash
git@github.com:johnata/ci4-crud.git
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
