# Tape Mastering Website

A small web app to facilitate audio mastering - built with Laravel.

## Get Started

Prerequisites:

-   Composer
-   Docker Desktop
-   Npm >= 20.0.0

Once the repo is cloned install PHP Vendors:

```bash
composer install
```

With the vendors installed and Docker running you can boot up a server with:

```bash
./vendor/bin/sail up
```

Then install our static asset bundling tools:

```bash
npm install
```

Once installed you can run the command to begin Vite bundling js and scss:

```bash
npm run dev
```

### Database

To prepare the database from the database seeder:

```bash
./vendor/bin/sail artisan migrate --seed
```
