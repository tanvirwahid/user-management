To run this project in local environment:

* First clone this project.
* Go to the project directory and run 'cp .env.example .env'
* Run 'composer install'
* Open .env file and enter database credential. For example

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Your_database
DB_USERNAME=root
DB_PASSWORD=

* Enter default admin email and password here:
ADMIN_EMAIL=
ADMIN_PASSWORD=

* Change QUEUE_CONNECTION to database
QUEUE_CONNECTION=databases

* Enter your email credentials in email related fields. For example, if you are using mailtrap for testing then these fields will be

MAIL_DRIVER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_smtp_username
MAIL_PASSWORD=your_mailtrap_smtp_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=YOUR_EMAIL_ADDRESS
MAIL_FROM_NAME="Bit Mascot"

* Run 'php artisan migrate', then 'php artisan db:seed', 'php artisan key:generate', 'php artisan storage:link' and then 'php artisan serve'
* Open another terminal and run 'npm install && npm run dev'
* Open another terminal and run 'php artisan queue:work'
* Open browser and go to localhost:8000