# MiniSend (MailerSend test assignment)
### Author: Vitaly Nikolenko (vit@webstandart.ru)

## Usage

```bash
# clone the repository
git clone https://github.com/vniko/mailer-send-test

# install packages
composer install

# copy .env.example to .env
cp ./.env.example ./.env 

# set database and queue connection credentials

# run migrations
php artisan migrate

# run seeders
php artisan db:seed

# install npm packages
yarn 

# build app
yarn build

# start Laravel
php artisan serve


# start queue worker
php artisan queue:work
```

Access application at `http://localhost:8000`.
