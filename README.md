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
php artisan migrate
```
now go http://localhost:8000/

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
