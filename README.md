# AvatarForum


To launch project
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