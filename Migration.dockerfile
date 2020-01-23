FROM adoptopenjdk:11-jre-hotspot
COPY ./mongodb/Migration.jar /mongodb/

EXPOSE 3306 3306
CMD ["java","-jar","./mongodb/Migration.jar"]
