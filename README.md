# MyLotto Laravellel és mysql-lel  
Futtatni szükséges a migraciót és a seedet  

```bash
php artisan migrate:fresh --seed
```
.env készítése  
példa:  
  
APP_NAME=MyLotto  
APP_ENV=local  
APP_KEY=...  
APP_DEBUG=true  
APP_URL=http://localhost  
APP_LOCALE=en  
APP_FALLBACK_LOCALE=en  
APP_FAKER_LOCALE=en_US  
APP_MAINTENANCE_DRIVER=file  
PHP_CLI_SERVER_WORKERS=4  
BCRYPT_ROUNDS=12  
DB_CONNECTION=mysql  
 DB_HOST=127.0.0.1  
 DB_PORT=3306  
 DB_DATABASE=test  
 DB_USERNAME=root  
 DB_PASSWORD=  
SESSION_DRIVER=database  
SESSION_LIFETIME=120  
SESSION_ENCRYPT=false  
SESSION_PATH=/  
SESSION_DOMAIN=null  
BROADCAST_CONNECTION=log  
FILESYSTEM_DISK=local  
QUEUE_CONNECTION=database  
CACHE_STORE=database  
MEMCACHED_HOST=127.0.0.1  
VITE_APP_NAME="${APP_NAME}"  
TICKET_PRICE=330  
WIN_AMOUNT=200  
  
## Funkciók  
Auth funkciók: Register,Login,stb  
Szelvény beküldése  
Lehet jelölni vagy random számok  
Szelvények listázása  
Sorsolás: A sorsolt számok alapján ellenőrzi az aktív szelvényeket, összeszámolja a találatokat,ha van találat akkor megjeleníti a számot, az egyenleget módosítja, a szelvények inaktív státuszba kerülnek  
