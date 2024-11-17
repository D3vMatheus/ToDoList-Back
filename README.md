# Project Setup and Initialization Guide

This guide will walk you through the steps to set up and initialize the project using Docker for the API. Follow the steps carefully to get the environment up and running.

## Prerequisites

Before starting, make sure you have the following tools installed:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/)

## Steps to Initialize the Project

### 1. Clone the Project

Start by cloning the project repository to your local machine:

```bash
git clone <repository-url>
cd <project-directory>
```
Replace <repository-url> with the actual repository URL and <project-directory> with the folder name created after cloning the repository.

### 2. Configure the Environment
After cloning the project, you need to set up the environment variables.

#### 2.1 Rename .env.example
In the root folder of the project, you will find a file named .env.example. Rename it to .env:

```bash
mv .env.example .env
```
#### 2.2 Update Database Configuration
Open the .env file and replace the database configuration section with the following values:

```ini
DB_CONNECTION=mysql
DB_HOST=db-to-do-list
DB_PORT=3306
DB_DATABASE=db_to_do_list
DB_USERNAME=root
DB_PASSWORD=root
DB_ROOT_PASSWORD=root
```
Make sure to comment out or delete the existing SQLite configuration lines, which should look like this:

```ini
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```
### 3. Start the Docker Containers
Next, you will use Docker Compose to set up and run the project containers.

#### 3.1 Build the Docker Containers
To build the Docker containers for the project, run the following command:

```bash
docker-compose up --build
```
This will create and build the necessary containers for the project.

#### 3.2 Start the Docker Containers
Once the build process is complete, start the containers in detached mode by running:

```bash
docker-compose up -d
```
This will start the containers in the background.

#### 4. Set Up the API
You will need to run a couple of commands inside the API container to install dependencies and set up the database.

#### 4.1 Access the API Container
To access the API container, run the following command:

```bash
docker exec -it <api-container-name> bash
```
Replace <api-container-name> with the actual name or ID of your API container (you can find it by running docker ps).

#### 4.1.1 If you're using Docker desktop open the container interface and click on bash.

#### 4.2 Install Composer Dependencies
Once inside the container, run the following command to install PHP dependencies via Composer:

```bash
composer install
```
#### 4.3 Run Database Migrations
After the dependencies are installed, run the database migrations to set up the required database schema:

```bash
php artisan migrate
```
This will create the necessary tables in the database.
