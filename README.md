# WP Anomeo
## Setup:

-   for Windows install and setup docker together with WSL2 - [tutorial](https://docs.docker.com/docker-for-windows/wsl/)
-   for other systems just install docker-compose using docs - [docs link](https://docs.docker.com/compose/install/)

-   to start project run `docker-compose up -d`

-   wordpress site link http://localhost:8080
-   phpmyadmin link - http://localhost:8081

-   db credentials and ports can be changes inside `docker-compose.yml` file

-   run ` docker-compose exec wordpress chmod -R a+rwx ./` to set proper permissions after first run
