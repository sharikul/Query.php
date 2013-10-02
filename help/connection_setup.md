## Connecting to the database
Query.php supports the MySQL and SQLite database drivers. It's fairly straightforward to connect to a MySQL database, as shown in `README.md`. 

To connect to the database via SQLite, you'll need to provide just **two** keys: 

* `driver` - set it equal to `sqlite`
* `sqlite_path` - set it equal to the path to the connection file

Usage:

```php
Query::setup( array(
	'driver' => 'sqlite',
	'sqlite_path' => 'path/to/db.db'
));
```

That's pretty much it. 

## Tips/Tricks
If you will be connecting to the database under the following conditions:

* `localhost` being the host,
* `root` being the user name,
* No password (_although you should be setting passwords_),
* `mysql` being the driver

The only thing you'll be required to provide is the name of the database, via the `database` key. 