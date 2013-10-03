# The `::run` method
`::run` is Query.php's alternative method(get it) of creating queries. It accepts both normal SQL queries as well as custom queries. This is the method to use in order to execute custom queries.

## API

```php
static function run( $query = '', array $placeholders = null);
```

## Usage

```php
$get_titles = Query::run("SELECT title FROM posts"); 
```

## Notes
If you would like to just execute normal SQL queries, you may also use the internal `::normal_sql` method, which accepts one parameter: the query.