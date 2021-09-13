
# SOA Example Project  
  
## Project setup  
  
```bash
composer i  
cp .env.example .env  
php artisan key:generate  
```  
  
Set the proper DB connection, mail, search and other services in your `env` file. After setting up `.env` run:  
```bash
php artisan migrate:fresh --seed  
```  
## API  
## activity 
.env
создать подключение к БД для хранения данных

## landing
.env
APP_PAGE_COUNT=5 - указать количество желаемых страниц
ENV_API_URL=http://soa-example-activity - указать путь до activity
подключение к БД не нужно.