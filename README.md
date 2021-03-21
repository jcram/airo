## Steps to execution 

##### Database:

- There is one docker-compose.yml file for the database, make sure that if you want to use if you have the docker and docker compose installed 
- Run docker-compose up (you can config inside the docker-compose.yml the credentials to the database)
- Make sure that what is in the docker-compose.yml is the same as .env

##### Steps to execute:

- copy the .env.example into one filled called .env
- make sure about the db credentials
- composer install
- php artisan migrate
- php artisan jwt:secret
- php artisan serve

##### You can test only the backend by the postman collection


- [Postman collection](https://www.getpostman.com/collections/de61ad01318dd4a3d849).
- First register, then login, and then use the token to use the quotation 
