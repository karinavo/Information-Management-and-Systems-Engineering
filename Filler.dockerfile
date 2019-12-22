FROM java:8
WORKDIR /
COPY ./mysql /mysql/
EXPOSE 8080
CMD java -jar DATAGENERATOR.jar

