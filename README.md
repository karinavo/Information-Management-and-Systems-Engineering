# IMSE: Milestone 2

by 
@author: Karina Volobuieva and 
@author: Lujza Lanyi

## Description: Kochkurs

Read this for important remarks about our project
{: .alert .alert-info}

### 2.1 Infrastructure
- **IS container, composition, isolation**
and deployment
    - We have 3 containers:
        - imse-app containing the webserver; it enables the php files to be accessed over <http:\\localhost:8080>
        - mariadb - the database on port 3306
        - filler - which is a java container. It fills the database
- **Secure webserver (https)**
    - Has been achieved by using a self-signed certificate, which is being copied over to the imse-app container via dockerfile
    - Open the website on <https:\\localhost:433>
    - Since it is a self-signed certificate there will be a warning screen displayed, it can be bypassed to access the website

### 2.2 Logical/Physical database design
- we are using a MySQL database (mariadb), for further Information look in the */docs* directory

### 2.3 Data import
- filling is done over a Java program using JDBC to connect to the MySQL database, we are using the C3PO library to enable connection pooling because of containers not "waiting" for each other to get ready
- we bundled all needed libraries and the Java code into a single jar file for convenience, but the code can be seen too
 
### 2.4 Implementation of Web System (relational DBMS)
- We implemented at least four use cases, since we are two people
    - Main use case :
    - Use Case 2:
    - Use Case 3:
    - Elaborate reporting use case:

### Additional information
- The work protocol can be found in /docs

## Instructions and troubleshooting

### How to build and run the project

With docker-compose

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
docker swarm init 
docker stack deploy -c docker-compose.yml imse # this will take a while too
docker swarm leave
```

{::options parse_block_html="true" /}