# Execute
```php artisan serve```

# Endpoints
ListAll: http://127.0.0.1:8000/api/users

ListOne: http://127.0.0.1:8000/api/user/1

Post: http://127.0.0.1:8000/api/user
```
{
"name": "teste",
"email": "joaopauloln7@gmail.com",
"gender": "man",
"birthday": "1984-05-05"
}
```

PUT: http://127.0.0.1:8000/api/user/1
```
{
"name": "teste 2",
"email": "joaopauloln7@gmail.com",
"gender": "man",
"birthday": "1984-05-05"
}
```

DELETE: http://127.0.0.1:8000/api/user/4

# Tests
```
composer test
```
