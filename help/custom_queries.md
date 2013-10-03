# Building custom queries
Query.php now makes it possible for you build your own queries. This means that you can write queries in the way that you prefer and they would execute accordingly. Query.php's internal `::build` method allows you to programatically create custom queries.

## API
Here is the API representation of the `::build` method:

```php
static function build( $query, Closure $closure);
```

## Build queries
Here is how you would build a query that goes like this: `POSTS BY [author]` that returns every single post from the database that has been authored by the specified user(name):

```php
Query::build('POSTS BY %c', function($author) {
	return Query::select_where('author', ':author', 'posts', '', array(':author' => $author));
});
```

**Note: The `%c` placeholder is a reserved character that denotes the position of data**.

### Execute the custom query

```php
$posts_by_sharikul = Query::run('POSTS BY Sharikul Islam');
```



## Prerequisites
For custom queries to work, you'll need to ensure that the version of PHP you're running is at least on version **5.3.0**. Try creating queries on lower versions and you'll get an error message thrown. This is because the method makes use of [closures/anonymous functions](http://php.net/manual/en/functions.anonymous.php).

## Notes
In addition to the `::run` method, you may also use the internal `::exec_build` method which accepts one parameter: the custom query.

## Help & Guidance
Read up on the internal `::select_where` method in `make_queries.md` if you haven't already to view the API representation.

