FROM openjdk:7
COPY . /src/java/TestDataGenerator
COPY . /src/java/mysql-connector
WORKDIR /usr/src/filler
RUN javac -cp .:mysql-connector.jar TestDataGenerator.java
CMD ["java", "Main"]
