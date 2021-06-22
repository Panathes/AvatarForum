# AvatarForum

## Description

This is a school project. The application is used to resize images.
We used php poo without framework with mysql, rabbitMQ and docker.

## Developers

- Corentin Croizat
- Christophe Charlebois
- Clément Haller
- Guillaume Cornet

## Infrastructure

![archi](https://user-images.githubusercontent.com/34098640/122923210-bca43300-d364-11eb-86ac-fb765278387f.png)

## To launch project
```
docker compose up
```

To execute migration file inside database container
```
docker exec avatar-app sh -c 'mysql -uroot -proot avatar < ./migration/migration.sql'
```

Then you can call the api endpoints
* create user
```
POST localhost:8000/users
```
With `firstname`, `lastname`, 
`mail`, `password` and `avatar` (image)
as form-data.

* get user
```
GET localhost:8000/users/{user_id}
```

* get user avatar (image)
```
GET localhost:8000/users/{user_id}/avatar
```
