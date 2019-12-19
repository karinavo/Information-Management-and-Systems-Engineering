FROM openjdk:7
ADD ./src/java/TestDataGenerator.java /usr/src/filler/ 
ADD ./src/java/mysql-connector.jar usr/src/filler
WORKDIR /usr/src/filler
RUN javac -cp .:mysql-connector.jar TestDataGenerator.java
CMD ["java", "Main"]
