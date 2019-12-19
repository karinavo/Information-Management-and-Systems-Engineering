FROM mariadb:latest

ADD create.sql /docker-entrypoint-initdb.d

RUN chown -R mysql:mysql /docker-entrypoint-initdb.d/
