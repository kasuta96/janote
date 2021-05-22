# janote

command from janote-docker/src/
```

git clone https://github.com/kasuta96/janote.git
cd janote
code .
```
edit .env file (add mysql password)

```
docker-compose exec app bash
cd janote
composer install
php artisan key:generate
php artisan migrate:refresh
```
now go http://localhost:8000/

## seeder: auto add data to database
first register 1 account
then on bash terminal:
```
php artisan db:seed
```

## error
Git Error: warning: CRLF will be replaced by LF in ...
->fix:
- windows:
```
git config --global core.autocrlf input
```
- linux, mac:
```
git config --global core.autocrlf false
```
source: https://stackoverflow.com/a/5834094

   # M1チップ対応のため追記 (chi)
- dbに追加：
platform: linux/x86_64 
