<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://cigotracker.com/themes/basic/images/cigo-logos/Cigo-logo-sq128.png" height="90px">
    </a>
    <h1 align="center">Cigo Tracker Code Assignment</h1>
    <br>
</p>

This project was developed as a code assigment for Cigo Tracker and implements an order control system.
This project allows users to create, delete, view and manage orders on their web browser.

## Requirements
This project is build based on the PHP framework Yii 2 [Yii 2](http://www.yiiframework.com/).
In order to run it you will need to have the following:

- PHP 7.0 or higher
- Composer
- Yii 2
- MySQL
- Javascript
- JQuery


Configuration
------------

After cloning this project, to run it locally, you will have to follow the steps provided bellow.

### Install Dependencies

Run the following command to install all projects dependencies:

```composer install```

#### Setup the Database

Create a database called ```cigo``` or login to your SQL client and run the command provided on the sql file located
on the project root called ```database.sql```.

Now, edit the file `config/db.php` with your database connection configuration, for example:

```php
return [
 'class' => 'yii\db\Connection',
 'dsn' => 'mysql:host=localhost;dbname=yii2basic',
 'username' => 'root',
 'password' => '1234',
 'charset' => 'utf8',
];
```

After that, run the migrations to create the required tables by running:

```yii migrate```

Now, run the following command to serve the application:

```yii serve```

After that, you can access the application on your browser by navigating to the following URL:

~~~
http://localhost:8080
~~~

## Built With

* [Yii 2](http://www.yiiframework.com/) - The PHP framework used.
* [Composer](https://getcomposer.org/) - Dependency Management.
* [JUI](https://github.com/yiisoft/yii2-jui) - DatePicker component.
* [JQuery Confirm 3.3.2](https://craftpip.github.io/jquery-confirm/) - Package to manage success, error and confirmation messages display.
* [Font Awesome 5.12.1](https://fontawesome.com/) - Nice icons provider.
* [Leaflet 1.6.0](https://leafletjs.com/) - Interactive maps.

## Author

* **Rayane de Araújo**