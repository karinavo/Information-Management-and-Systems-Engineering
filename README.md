# IMSE Project

#### Meine Notizen: (du kannst auch darin schreiben)
https://hackmd.io/@nox/BkgZ1bSRr

#### Work protocol link: 
https://docs.google.com/spreadsheets/d/1MJdZD42Lzvqad4Mxh0sp7r5av4WASuu324qj9NUpAp0/edit?usp=sharing

Datenbank in container bringen:
https://medium.com/better-programming/setting-up-mysql-database-in-a-docker-d6c69a3e9afe

Um die database zu managen eventuell



#### RESTARTING THE WHOLE CONTAINER FROM SCRATCH (USEFUL):

Stop the container(s) using the following command:

`sudo docker-compose down`

Delete all containers using the following command:

`sudo docker rm -f $(sudo docker ps -a -q)`

Delete all volumes using the following command:

`sudo docker volume rm $(sudo docker volume ls -q)`

Restart the containers using the following command:

`sudo docker-compose up -d`

----------------------------

Run `sudo docker build .` in a directory with a dockerfile to test if it is working/to build the image

#### Troubleshooting

`Error in compose : Couldn't connect to Docker daemon - you might need to run docker-machine start default.`

OR 

`... Permission denied ...`

Solution: add sudo to command

