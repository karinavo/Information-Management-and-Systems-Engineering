FROM mariadb

ENV MYSQL_DATABASE=imse_db \
    MYSQL_ROOT_PASSWORD=rootpsw

ADD create.sql /docker-entrypoint-initdb.d

EXPOSE 3308
