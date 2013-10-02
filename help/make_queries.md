# Sending queries to the database
Query.php offers you flexibility in terms of sending queries to the connected database. This is accomplished via the internal `::query` method.

This is how simple you can make queries: 
```php
Query::_query('title', 'posts');
```

If you were to have a column called _title_ in a table called _posts_, this is how you can retrieve every single value of the column. **Lovely Jubbly!**

But this is how `::query` is meant to be used:

```php
Query::_query('', 'posts', array(
	'where' => 'author = :author',
	'placeholders' => array(':author' => 'Sharikul Islam'),
	'order_by' => 'date',
	'sort' => 'desc',
	'limit_start' => 0,
	'limit_end' => 6,
));
```

If this query was to be executed, you'd get every single post from the database which has been authored by _Sharikul Islam_ - but at 6 posts at a time!

Let's take a closer look at the `::query`` method:

**API**:
```php
static function _query( $column = '', $table = '', array $extra_options = null);
```