# What is Query.php?
Query.php is a new PHP based class that allows developers to interact with an SQL based database in an easy-to-write-and-understand format. All related methods are stored in the `Query` class. 

# System requirements
To ensure that Query.php works well, ensure that the following requirements are met.

* PHP **5.1.0** for general usage, or version **5.3.0** for custom query building is running,
* MySQL or SQLite Database is the database to connect with,
* PDO Module is installed in the copy of PHP that's running on the server. 

# How to get started
First and foremost, it is vital that you get Query.php connected to the database before executing anything. You can do this via the internal `::setup` method, like so:

```php
Query::setup( array(
	'host' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'blog',
	'driver' => 'mysql'
));
```

`::setup`'s API representation:

```php
static function setup( array $options);
```

# Continue learning
The included `/help` directory contains a variety of `.md` files about different topics, such as making queries, using internal getters, and creating custom formatted queries. Whenever the specification is updated, `/help` will also be updated with the relevant resources.

Enjoy!
