# techtest_pmfy
Only a tech test

## Requirements
Windows, Linux, or Mac with Docker 

In case that you have no option `compose` on your Docker version, install and use `docker-compose` instead

---
## Installation
Here you can find the way to deploy the project on both OS types (Windows and Linux/MacOs)

Copy the required .env file (test in this case) running `cp test.env .env` 

### On Windows
I recommend using the Windows Powershell instead of CMD or Bash for Windows

To install the project, first copy the docker-compose for your OS 
```PowerShell
PS C:\project-location> cp docker-compose-windows.yml docker-compose.yml
```

#### Run the containers
```PowerShell
PS C:\project-location> docker-compose -p paymefy up -d --remove-orphans
```

#### Install the project with composer
```PowerShell
PS C:\project-location> docker-compose exec php composer install
```

#### Create the database
```PowerShell
PS C:\project-location> docker-compose exec php php bin/console doctrine:database:create
```

#### Finally, run the migrations
```PowerShell
PS C:\project-location> docker-compose exec php php bin/console doctrine:migrations:migrate
```
---
### On Linux/MacOs
#### You can take the advantage of the Makefile
To install the project, first copy the docker-compose for your OS 
```bash
your@machine:/project-location$ cp docker-compose-unix.yml docker-compose.yml
```
And then run the make command
```bash
your@machine:/project-location$ make install
```

---
## Usage
To run the code, you have to enter inside php container and run your code

### Enter inside php container
#### On Windows (PowerShell)
```PowerShell
PS C:\project-location> docker-compose exec php /bin/bash
```

#### On Linux/MacOs
```bash
your@machine:/project-location$ make shell
```

### Running the commands
Right now, you are inside the container with all the dependencies installed to run your code, just make sure to run the commands in the application folder, see that `pwd` have to return the '/home/user/app' location

#### Run the command with --help to see the options
```bash
bash-5.1$ php bin/console pmfy:get:expiring --help
```
You have to see the help message from this command, like this
```bash
Description:
  Get all clients that their renewals Expires soon and exports it to xml, json or database

Usage:
  pmfy:get:expiring [options] [--] <format>

Arguments:
  format                   The format to export the data, values can be xml, json or db

Options:
      --filename=FILENAME  Specify the file location and name, if not specified, it will be a random filename inside ./public folder
```
If you want, you can run the command from outside too
```bash
docker-compose exec php php bin/console pmfy:get:expiring json
```
The exmaple creates the Json file with the Clients list

That's it!


