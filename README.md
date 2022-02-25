<h1 align="center">Soccer</h1>


## About Soccer
This application is to see the soccer teams details. User and Guest user can see the teams and its player details, and Only admin will be able to manage the teams details. This application is build based on REST API.

#### There are some key features like
- Create Soccer Teams
- Edit & Delete Teams
- View Team List
- Add players to Team
- View Player list with respect to teams
- Edit and delete players


This application have Guest, user and admin role. Admin only able to do the creat, edit and delete action for both Team and players.

## To Run The Application with Docker
First rename `.env.example` to `.env`  
Start the docker with command -`docker-compose up -d`       
Now we have to setup laravel application, so run the below commands.   
1.`docker-compose exec php-apache /bin/bash `   
2.`cd ..`  
3.`composer update --no-scripts`  
4.`php artisan storage:link`  
5.`php artisan migrate`

For Migrate database
Now access the application by go to http://localhost:8088 url.

## API documentation

API documentation added with swagger. To see the documentation please goto this http://localhost:8088/api/documentation  link.






