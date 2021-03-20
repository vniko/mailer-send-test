# MiniSend (MailerSend test assignment)
### Author: Vitaly Nikolenko (vit@webstandart.ru)

## Usage

### Development

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

# start Laravel
php artisan serve

# start Nuxt
npm run dev
```

Access application at `http://localhost:3000`.
