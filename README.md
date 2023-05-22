## Quick Start

```bash
# clone repository
git clone git@github.com:kibo13/sport-services.git

# install php packages
composer install

# install javascript packages
npm install 

# copy file .env
copy .env.example .env

# generate a key
php artisan key:generate

# database configuration
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=database_username
DB_PASSWORD=database_password

# email configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.email_service
MAIL_PORT=465
MAIL_USERNAME=email_username
MAIL_PASSWORD=email_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=email_username

# filesystems configuration
php artisan storage:link
```
