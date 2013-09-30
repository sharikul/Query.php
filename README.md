Query.php
=========

## What is Query.php?
Query.php is a new PHP based class that allows developers to interact with the database in an easy-to-write-and-understand format. 

## System requirements
Here are the system requirements for Query.php: 
* PHP version 5.3.0 or greater - running Query.php on any lower versions will result in an error message being thrown.
* SQL based database
* PDO module

## Setup
##### ::setup()
The `::setup()` method takes one parameter - an array, in which you specify credentials.

#####API: 
```php
static function setup( array $options );
```

##### Usage:
```php
Query::setup( array(
  'host' => 'localhost',
  'username' => 'root',
  'password' => '',
  'database' => 'blog',
  'driver' => 'mysql'
));
```

Query.php applies some default values to the connection credentials whenever it's not provided by the user.

```php
'host' => 'localhost',
'username' => 'root',
'password' => '',
'database' => '',
'driver' => 'mysql'
```

If you are connecting to a database with `localhost` being the host, `root` being the username, no password, and driver being `mysql`, the only thing you'll need to provide to `::setup` is the name of the database you want to connect with.

## General usage
It's fairly easy to begin using Query.php with the range of methods it comes built in with. 

### 1. `::_query`
`::_query` lets you make queries to the database. It takes the name of the column in a table, followed by the name of the table. Additional options are then passed to this function via the `$extra_options` array, which is set to `null` by default.

##### API:
```php
static function _query( $column = '', $table = '', array $extra_options = null ); 
```

##### Basic usage:
```php
$my_query = Query::_query('title', 'posts');
```

By default, the example query above will return every `title` column from the `posts` database. In addition, if you don't specify a column, the method will return all table rows. But this method is built to do more things, and this is accomplished by the `$extra_options` array that it accepts.

##### Full usage:
```php
$my_advanced_query = Query::_query('title', 'posts', array(
  'where' => 'title = :title',
  'placeholders' => array(':title' => 'My post title!'),
  'order_by' => 'published',
  'limit_start' => 0,
  'limit_end' => 6,
  'sort' => 'desc'
));
```

The SQL code that the function would then generate taking into all the supplied parameters into account would look like this:

```sql
SELECT title FROM posts WHERE title = :title ORDER BY published DESC LIMIT 0,6
```

**Note: If you've made use of PDO placeholders like the example above, simply provide a key called 'placeholders' with the array that links the placeholder to its value just as shown in the above demo and Query.php will execute the query accordingly.**

There are *nine* keys that the method accepts in the `$extra_options` array:

###### 1. `action`
`action` refers to the operation the SQL code would perform, such as `SELECT` or `UPDATE`. Query.php accepts: `SELECT`, `INSERT`, `UPDATE`, `DELETE`, `DESCRIBE`, and `EXPLAIN`. By default, the action is set to `SELECT`, but this can always be changed by providing an `action` key to the array. 

###### 2. `limit_start`
`limit_start` is the number at which the database should start filtering a set of records. In SQL speak, this would look like `LIMIT [limit_start]`.

###### 3. `limit_end`
`limit_end` is the max number of records the database should show at a time. In SQL speak, this would look like: `LIMIT 0, [limit_end]`. 

###### 4. `order_by`
`order_by` refers to the name of the column whose data should be used in order to order a set of records, for example `ID` or `date`. In SQL, you would write it like this: `ORDER BY [column]`.

###### 5. `sort`
`sort` refers to the direction of order. Ascending order will display records from old to new, while a descending order will display records from new to old. This is represented by `ASC` or `DESC`. 

###### 6. `where`
`where` refers to the clause at where you can filter out data from the database based on a condition. In SQL, you would do something like: `WHERE title = "Hello!"`. Write the clause as is, meaning write the `where` clause like you write it in normal SQL.

###### 7. `placeholders`
Since Query.php utilizes PHP's PDO class, it also carries support for placeholders. Placeholders look like this: `:placeholder`. Provide an array to this key, with the placeholder in its format (with the colon) being the key and its value being the value of the placeholder.

###### 8. `update_sets`
You wouldn't need to supply this key unless you're executing an `UPDATE` statement. Provide an array to this key, with the key being the name of the column, and its value being the new value of the column. 

###### 9. `custom`
Just incase you would want to write your own SQL code, you can do so via the `custom` key. You won't need to provide any other key other than `placeholders` - but that's only if you're making use of them in your SQL code. Usage: `'custom' => 'SELECT title FROM posts'`.

### 2. `::build`
Query.php lets you define your own query format. Yes! That means you can finally perform SQL operations in the language that you want to! But first things first, you'll need to define a format, via the `::build` method. A format points to a callback function (also known as _closures_), that is executed when the format is processed. The `%c` placeholder is used to denote areas of varied data.

##### API:
```php
static function build( $query, Closure $closure);   
```

Example usage:
```php
Query::build('FETCH POSTS BY %c', function($author) {
  return Query::_query('', 'posts', array(
    'where' => 'author = :author',
    'placeholders' => array(':author' => $author)
  ));
});
```

### 3. `::run`
The `::run` method executes plain SQL and custom format code. That's really it.

##### API:
```php
static function run( $query, array $placeholders = null);
```

##### Usage (without custom format)
```php
$query = 'SELECT * FROM posts WHERE author = :author';
$query_arr = Query::run($query, array(':author' => 'Sharikul Islam');
```

##### Usage (with the custom format created earlier)
```php
$query = 'FETCH POSTS BY Sharikul Islam';
$query_arr = Query::run($query);
```

# More documentation coming soon as the project progresses.
