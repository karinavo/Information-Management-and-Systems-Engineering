# IMSE: Milestone 2

Work protocol
https://docs.google.com/spreadsheets/d/1PpaXgwWq_DQRdT-fLpN3_n-p3j1A6-5r_w8TBwxpkiI/edit?usp=sharing

Beschreibungsprotokoll
https://docs.google.com/document/d/1Y5EHAlNZFmE4NzByXeuivZG0mvN3e2SYq4aQyD3tEwU/edit?usp=sharing

by 

@author: Karina Volobuieva and 

@author: Lujza Lanyi

## Description: Kochkurs

::: info

Read this for important remarks about our project

:::

### 2.1 Infrastructure
- **IS container, composition, isolation**
and deployment
    - We have 3 containers:
        - imse-app containing the webserver; it enables the php files to be accessed over <http:\\localhost:8080> and <https:\\localhost> for https
        - mariadb - the database on port 3306
        - filler - which is a java container. It fills the database
- **Secure webserver (https)**
    - Has been achieved by using a self-signed certificate, which is being copied over to the imse-app container via dockerfile
    - Open the website on <https:\\localhost:433>
    - Since it is a self-signed certificate there will be a warning screen displayed, it can be bypassed to access the website
    - it is also possible to add the certificate manually to let it be displayed as secure
    - in Firefox this is done in certificate settings:
    		- Firefox `preferences` -> `privacy & security` -> `certificates` -> `view certificates` -> import -> select the certificate in the `web` folder (`server.crt`) -> select `University of Vienna: localhost` in the list -> `edit trust` -> check `this certificate can identify websites` -> `ok` -> refresh the page
    - in other browsers you have to look up how to do this
    - or you can add the certificate globally to the system to be trusted

### 2.2 Logical/Physical database design
- we are using a MySQL database (mariadb), for further Information look in the */docs* directory

### 2.3 Data import
- filling is done over a Java program using JDBC to connect to the MySQL database, we are using the C3PO library to enable connection pooling because of containers not "waiting" for each other to get ready
- we bundled all needed libraries and the Java code into a single jar file for convenience, but the code can be seen too
 
### 2.4 Implementation of Web System (relational DBMS)
- We implemented at least four use cases, since we are two people
    - Main use case : Organise cooking course [X]
    - Use Case 2: Lead cooking course [x]
    - Use Case 3: Sign up for cooking course [x]
    - Elaborate reporting use case: [X]

### Additional information
- The work protocol can be found in /docs

## Instructions and troubleshooting

### How to build and run the project

With docker-compose
(FOR MS3 sudo is needed because of protected portainer and mongo data folders!)

```bash
cd /imse
# Optional: Building takes quite a while
# docker-compose build
docker-compose up # else it will build the images here 
docker-compose down
```


With docker stack 

```bash
cd /imse
docker-compose build
docker swarm init
docker stack deploy -c docker-compose.yml imse # this will take a while too
docker swarm leave
```

### Problem: Tables did not get created (errors show up in the php instead of displaying a table with data) when using docker stack deploy

1. run `docker-compose build --no-cache` in the root directory

### Problem: Data did not get filled in when running docker-compose up

1. Wait. Maybe it did not have enough time to be filled in yet

2. try restarting the contaner 

```
docker ps # find out the id or name of the filler container
docker restart <filler id/filler name>
```
