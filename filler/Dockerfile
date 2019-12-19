FROM openjdk:7
COPY . /src/java/TestDataGenerator.java
COPY . /src/java/mysql-connector.jar
WORKDIR /usr/src/filler
RUN javac -cp .:mysql-connector.jar TestDataGenerator.java
CMD ["java", "Main"]
