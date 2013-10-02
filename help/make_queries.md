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

## Internal helpers
Query.php also comes built in with some helper functions that make use of `::_query` so you don't.

* **select_where**
Use this helper to select a column or a set of records based on a condition. 

```php
Query::select_where('author', ':author', 'posts', 'title', array(':author' => 'Sharikul Islam');
```

**Note: You aren't required to provide the placeholders array at the end if you aren't making use of them when constructing queries.**

**API**:
```php
static function select_where($column = '', $value = '', $table = '', $specific_column = '', array $placeholders = null);
```

* **update_where**

