# techtest_pmfy
Only a tech test

## Requirements
Windows, Linux, or Mac with Docker 

In case that you have no option `compose` on your Docker version, install and use `docker-compose` instead

## Installation
Here you can find the way to deploy the project on both OS types (Windows and Linux/MacOs)

### On Windows
I recommend using the Windows Powershell instead of CMD or Bash for Windows

#### Run the containers
```PowerShell
PS C:\project-location> docker-compose -p paymefy up -d --remove-orphans
```

### On Linux

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
OR
```shell
your@machine:/project-location$ export USER_ID=1000
```

Then run the containers
```shell
your@machine:/project-location$ docker-compose -p paymefy up -d --remove-orphans
```

And run the composer installation
```shell
your@machine:/project-location$ docker-compose exec -u user -w "/home/user/app" php composer install
```

## Usage
To run the code, you have to enter inside container and run your code

### Enter inside php container

#### On Windows (PowerShell)
```PowerShell
PS C:\project-location> docker-compose exec php /bin/bash
```
#### On Linux/MacOs
```shell
your@machine:/project-location$ make shell
```

### Running the application commands
In this step, you are inside the container with all the dependencies installed to run your code, then just run the command you want
Ex.
```shell
bash-5.1$ bin/console cache:clear
```
Or whatever the command you want to run

