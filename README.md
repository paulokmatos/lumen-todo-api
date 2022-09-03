
# Lumen Todo-API  
  
### Technologies:  
- PHP 7.4+  
- Laravel/Lumen Framework  
- Composer 2.0  
- MySQL  
  
### Development utilizing:  
- TDD ( Test-Driven Development)  
- Unite Tests (w/ PHPUnit)  
  
# Description  
  
A Simple API project build to practice TDD methodology and unit tests w/ PHPUnit.  
  

# How to Setup
#### You will need:
PHP 7.4+
Composer
any SQL Database

    # Clone this Repository
    $ - git clone https://github.com/paulokmatos/lumen-todo-api
    $ - cd lumen-todo-api
    $ - composer install
    
    # Make sure you added your env variables in .env.example file
    $ - php artisan migrate:fresh 
    $ - php -S localhost:8000 -t public


**Show Todos**  
----  
Returns json pagination with all todos.  
  
* **URL**  
  
  /todos  
  
* **Method:**  
  
 `GET`  
  
**Add Todo**  
----  
Add a new Todo on Database.  
  
* **URL**  
  
  /todos  
  
* **Method:**  
  
 `POST`  
*  **URL Params**  
 `title=[string]`  
 `description=[string]`  
 **Example:**  
  
 ```JSON {  
   "title": "Do something",   
   "description": "do something today 4:00PM"  
  ```
**Get Todo by ID**  
----  
  Returns a specific todo.  
  
* **URL**  
  
  /todos/:id  
  
* **Method:**  
  
 `GET`
* **Returns Example:**
```JSON
{

"id": 2,

"title": "Do something",

"description": "do something today 4:00PM",

"done": false,

"done_at": null,

"created_at": "2022-09-03T20:54:47.000000Z",

"updated_at": "2022-09-03T20:54:47.000000Z"

}
```

**Update Todo status**  
----  
Update todo status.  
  
* **URL**  
  
  /todos/:id/status/:status
  *The only two status accepted are: **done**  and **undone***
  
* **Method:**  
  
 `POST` 
 *  **URL Params**  
 `id=[integer]`  
 `status=[string]`  
* **Example:**
	/todos/2/status/done
```JSON
{
"id": 2,
"title": "Do something",
"description": "do something today 4:00PM",
"done": true,
"done_at": "2022-09-03T21:06:35.907222Z",
"created_at": "2022-09-03T20:54:47.000000Z",
"updated_at": "2022-09-03T21:06:35.000000Z"
}
```

**Delete a Todo**
---
Delete a todo from database.

* **URL**  
 
  /todos/:id
  
  **Returned Status:** 
  `204 No Content`
  
