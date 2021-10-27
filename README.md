<h1 align="center">Soccer</h1>


## About Soccer
It is REST full application, where user can maintain their soccer teams with logo and player details, Details like First Name, Last Name and Image.
There are some key features like
- Create Soccer Teams 
- Edit & Delete Teams 
- View Team List
- Add players to Team
- View Player list with respect to teams
- Edit and delete players


This application have Guest, user and admin role. Admin only able to do the creat, edit and delete action for both Team and players.

## Get JWT token

### Request

`Post /api/login`

    curl -i -H 'Accept: application/json' -d "email=bibhudattasahooTest@gmail.com&password=adadas" http://localhost.soccer.com/api/login

### Response

    {"message":"Login successfully"}

## Get Teams

### Request

`Get /api/teams`

    curl -i -H 'Accept: application/json' http://localhost.soccer.com/api/teams

### Response
    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    {"message":"Success","data":[{"id":1,"name":"CSKs","logo":"http:\/\/localhost.soccer.com\/storage\/9cNxFkEYcqVfAOc6FHOLTaeNWjDsSbyW5vfwsbKt.png","created_at":"2021-10-17T11:30:03.000000Z","updated_at":"2021-10-26T14:51:03.000000Z"}}]}

## Get Team's players

### Request

`Get /api/players/{teams}`

    curl -i -H 'Accept: application/json' http://localhost.soccer.com/api/players/1

### Response
    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    {"message":"Success","data":[{"id":1,"first_name":"Bibhudatta","last_name":"Sahoo","image":"http:\/\/localhost.soccer.com\/storage\/Bibhudatta1634541299.image\/png","team_id":1,"created_at":"2021-10-18T07:14:59.000000Z","updated_at":"2021-10-19T10:55:04.000000Z"}]}

## Create Team

### Request

`Post /api/team`

    curl -i -H 'Accept: application/json' -d 'name=test&logo=file' http://localhost.soccer.com/api/team

### Response
    HTTP/1.1 200 OK
    Status: 201 Created
    Connection: close
    Content-Type: application/json

    {"message":"Created Team successfully"}


## Update Team

### Request

`Put /api/team/{teams}`

    curl -i -H 'Accept: application/json' -d 'name=test&logo=file' http://localhost.soccer.com/api/team/1

### Response
    HTTP/1.1 200 OK
    Status: 200 Ok
    Connection: close
    Content-Type: application/json

    {"message":"Update Team successfully"}



## Delete Team

### Request

`Delete /api/team/{teams}`

    curl -i -H 'Accept: application/json' http://localhost.soccer.com/api/team/1

### Response
    HTTP/1.1 200 OK
    Status: 200  Ok
    Connection: close
    Content-Type: application/json

    {"message":"Deleted Team successfully"}


## Create Player

### Request

`Post /api/player`

    curl -i -H 'Accept: application/json' -d 'first_name=test&last_name=test&image=file&team=1' http://localhost.soccer.com/api/player

### Response
    HTTP/1.1 200 OK
    Status: 201 Created
    Connection: close
    Content-Type: application/json

    {"message":"Player created successfully"}


## Update Player

### Request

`Put /api/player/{players}`

    curl -i -H 'Accept: application/json' -d 'first_name=test&last_name=test&image=file&team=1' http://localhost.soccer.com/api/player/1

### Response
    HTTP/1.1 200 OK
    Status: 200 Ok
    Connection: close
    Content-Type: application/json

    {"message":"Players updated successfully"}



## Delete Player

### Request

`Delete /api/player/{players}`

    curl -i -H 'Accept: application/json' http://localhost.soccer.com/api/team/1

### Response
    HTTP/1.1 200 OK
    Status: 200  Ok
    Connection: close
    Content-Type: application/json

    {"message":"Player deleted successfully"}


## Logout

### Request

`Post /api/logout`

    curl -i -H 'Accept: application/json' http://localhost.soccer.com/api/players/1

### Response
    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

     "message": "Logout Successfully"


