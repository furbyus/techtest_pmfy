# techtest_pmfy
Only a tech test

## Requirements
Windows, Linux, or Mac with Docker 

In case that you have no option `compose` on your Docker version, install and use `docker-compose` instead

---
## Installation
Here you can find the way to deploy the project on both OS types (Windows and Linux/MacOs)

### On Windows
I recommend using the Windows Powershell instead of CMD or Bash for Windows

#### Run the containers
```PowerShell
PS C:\project-location> docker-compose -p paymefy up -d --remove-orphans
```

#### Install the project with composer
```PowerShell
PS C:\project-location> docker-compose exec -w "/home/user/app" php php composer install
```

#### Create the database
```PowerShell
PS C:\project-location> docker-compose exec -w "/home/user/app" php php bin/console doctrine:database:create
```

#### Finally, run the migrations
```PowerShell
PS C:\project-location> docker-compose exec -w "/home/user/app" php php bin/console doctrine:migrations:migrate
```
---
### On Linux/MacOs
#### You can take the advantage of the Makefile
```shell
your@machine:/project-location$ make install
```
#### Or doing it through docker-compose 
In this way, in order to avoid permissions issues on the application files, you have to set the owner id of the folder in your local machine. 
Usually the same user that is running the command, then you can get the id running the command `id -u` on a shell or setting it manually:

```shell
your@machine:/project-location$ export USER_ID=`id -u`
```
Then follow the steps on the windows installation adding the user flag `-u user` (see Makefile for reference)

---
## Usage
To run the code, you have to enter inside php container and run your code

### Enter inside php container
#### On Windows (PowerShell)
```PowerShell
PS C:\project-location> docker-compose exec php /bin/bash
```

#### On Linux/MacOs
```shell
your@machine:/project-location$ make shell
```

### Running the commands
Right now, you are inside the container with all the dependencies installed to run your code, just make sure to run the commands in the application folder, see that `pwd` have to return the '/home/user/app' location

#### Run the command with --help to see the options
```shell
bash-5.1$ php bin/console 
```

