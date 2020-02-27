# Treasure Trail Web Application

This web application is designed for university students to find their way around campus,
making them go to important locations they will be visiting during their studies

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.
See deployment for notes on how to deploy the project on a live system.

### Prerequisites - if deploying locally

* XAMPP: https://www.apachefriends.org/download.html

### Prerequisites - if deploying online

* Access to cPanel

### Installing

Local Installation: Apache and MySQL services

```
After installing, run the control panel and start the Apache and MySQL services. 
Navigate to “localhost” in a web browser and go to phpMyAdmin where you can create a new database.
Using the ‘create_table.sql’ and ‘insert_data.sql’ files from the source code, go to the SQL tab and copy the file contents and execute the SQL statements. 
The database will be created. Your username/password (default, username: root, with an empty password) as well as database name need to be entered into the PHP source code.
The connection string located in the ‘app/database.php’ file, in the ‘open()’ function needs to be updated accordingly. For example:

$connection = new mysqli("localhost", "root", "", "databaseName");
```

Online Installation: cPanel

```
To redeploy on website hosting, navigate to the cPanel.
The source code files can be uploaded using the ‘File Manager’, the root directory is ‘public_html’.
The cPanel also includes phpMyAdmin therefore the same steps as before can be done.
```

## Deployment

Online Installation: cPanel

```
Navigate to your https://www.example.com/
```

Local Installation: Apache and MySQL services

```
Navigate to your local http://localhost/
```
## Built With

* [HTML]
* [CSS]
* [Javascript - Front_end]
* [PHP - Back_end]

## Authors

* **William Wallitt, Justin Van Daalen, Stephen Kubal, Bevan Roberts, Edward Soutar, Oliver Fawcett**

## License

This project is licensed under the Apache License 2.0 - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used, but is in the backend

