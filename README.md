# IMSE Project

Meine Notizen: (du kannst auch darin schreiben)
https://hackmd.io/@nox/BkgZ1bSRr

Work protocol link: 
https://docs.google.com/spreadsheets/d/1MJdZD42Lzvqad4Mxh0sp7r5av4WASuu324qj9NUpAp0/edit?usp=sharing

Datenbank in container bringen:
https://medium.com/better-programming/setting-up-mysql-database-in-a-docker-d6c69a3e9afe

Um die database zu managen eventuell

Für create tables:
cat /home/karina/Documents/IMSE/IMSEGIT/imse/mysql/create.sql |sudo docker exec -i mariadb_database /usr/bin/mysql -u root --password=rootpsw imse_db 


