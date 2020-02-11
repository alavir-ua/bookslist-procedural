[![Open Source Love](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)](https://github.com/ellerbrock/open-source-badges/)

# Simple PHP bookstore in the procedural style 

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Prerequisites
What things you need to install the software.

- Git.
- PHP.
- MySQL.
- XAMPP (or another local server).
- IDE (or code editor).

## Install
Clone the git repository on your computer
```
$ git clone https://github.com/alavir-ua/bookslist-procedural.git
```
You can also download the entire repository as a zip file and unpack in on your computer if you do not have git.

Restore database from file db_dump.sql


## Set environment keys
1.Edit file /config/dbconfig.php according to your values.
```
const DB_HOST = 'DB_HOST';
const DB_NAME = 'DB_NAME';
const DB_USERNAME = 'DB_USERNAME';
const DB_PASSWORD = 'DB_PASSWORD';
```
2.Edit file /config/site.php according to your values.
```
define('ADMIN_EMAIL', 'ADMIN_EMAIL'); 
define('SHOW_BY_DEFAULT', 6); 
define('SHOW_FOR_ADMIN', 10);
define('SITE_URL', 'SITE_URL'); 
```
## Run the application

Open a web browser and launch the application according to your settings.

## Links
[Live Demo](http://bookslist.is-best.net/)
