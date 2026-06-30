FROM mysql/mysql-server:5.7
COPY init.sql /docker-entrypoint-initdb.d/
EXPOSE 3306
ARG MYSQL_ROOT_PASSWORD
ENV MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD}
