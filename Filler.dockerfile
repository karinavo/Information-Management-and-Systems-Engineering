FROM adoptopenjdk:11-jre-hotspot
COPY ./mysql/DATAGENERATOR.jar /mysql/

EXPOSE 3306 3306
CMD ["java","-jar","./mysql/DATAGENERATOR.jar"]
