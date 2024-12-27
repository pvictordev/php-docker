# PHP & Docker
An example how to dockerize a php application and host it on an AWS EC2 instance. 

## Remarks
This is a basic php app docker container. To run it locally, run cmd: ``docker-compose up --build`` from the project directory in terminal.

When the container is running, it will be attached to port 80 of the local machine, go to: http://localhost:80 to view the site.

PHP app, by default, is running on port 8000 of the container, but the docker-compose binds host port 80 to container port 8000.

The following steps below only work if your local machine has same cpu arch as the ec2 instance (x86 or arm): To build the docker image locally, run command: ``docker build -t php-docker:v1.0 .`` from project dir.
