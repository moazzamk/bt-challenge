# BT Challenge

##Requirements
- Composer (https://getcomposer.org/doc/00-intro.md#globally)
- PHP >= 7.0 (http://php.net)
- SQLite extension for PHP
- PDO extension for PHP
- SQLite3


##Setup
Run the following commands to setup the project: 
```
cd /root/of/challenge/folder
composer install
```

##Running the app
Before running the project, database needs to be initialized. This can be done
with:

``` 
bin/cleardb
```

This command also clears the db if one already exists 


The project can be run with the following commands:
```
# Provide data.txt as an argument
bin/mcc data.txt

# Provide the contents of data.txt as an argument 
bin/mcc < data.txt
```

There is a sample file in fixtures folder that can be used. The output from the sample
file should look something like this:

```
Lisa: $-93
Quincy: error
Tom: $500
```

##Running the tests

Unit tests can be run with:

``` 
bin/phpspec run -vvv --format=pretty spec 
```

Integration tests can be run with:
```
bin/behat
```


##Design Decisions
The overall design of the project is a mix of ADR and command bus. 
The goal was to separate out the domain layer for re-usability between
different modes of requests (cli, web, a task runner).

Currently, only the command line interface has been implemented but hooking
a web or any other layer can be done without modifying any of the
existing code. 

- `bootstrap.php` contains the infrastructure code. It initializes the DI container
and adds services to it
- The domain logic is separated into `src` folder.
- SQLITE is used for persisting changes from the batch file. The data layer
 uses Repository pattern, Unit of Work, Data mapper patterns. 
- I chose to do this project in PHP because it has most of the libraries so it 
made development much faster. The other language I wanted to do this in is Go. 
 However, I would have had to write much more code. Given the time constraints 
 it wasn't ideal.

