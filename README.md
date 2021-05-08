# janote

command from janote-docker\src\janote
```
git init
git config --global user.email "email@gmail.com"
git config --global user.email "username"
git remote add origin https://github.com/kasuta96/janote.git
git pull origin master
...
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
