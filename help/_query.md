# Explore the `::query` method
The `::query` method is Query.php's main query initiator. As you have probably seen in the demo's, it is used to execute queries in different ways. 

**API**:

```php
static function _query($column = '', $table = '', array $extra_options = null);
```

## The `$extra_options` array
It is here where you can modify the query to be executed. The array accepts these **ten** parameters:

1. `action` (string) - The operation to be performed. Defaults to `SELECT`.
2. `where` (string) - The condition of a `WHERE` clause. Write it as is, i.e. write the clause how you would write it in plain SQL - just exclude the 'WHERE' keyword!
3. `placeholders` (array) - Since Query.php utilizes PHP's PDO class, it also carries support for placeholders. Provide an array of placeholders with the key being the placeholder in its form, and its value being the value of the placeholder.
4. `limit_start` (int) - The starting point of the limit. Defaults to **0**.
5. `limit_end` (int) - The maximum number of records to return. Defaults to **0**. 
6. `order_by` (string) - The name of the column whose data should be used to order a set of records.
7. `sort` (string) - The order that records should be displayed in. Defaults to **ASC** (ascending, old to new). Specify **DESC** to show records from new to old.
8. `update` (array) - The columns whose value should be updated. **This should only be specified if the `action` is set to `UPDATE`.**
9. `values` (array) - the values to be inserted into their respective columns. See the example below for a better understanding. 
10. `custom` (string) - The SQL code to be executed. **If this key is specified, do NOT provide any more keys, with the exception of `placeholders` if they are used in the query, as this could result in problems.**

**Example 1: Update columns**:

```php
Query::_query('', 'posts', array(
	'action' => 'update',
	'where' => 'title = :title',
	'placeholders' => array(
		':title' => 'A post title'
	),
	'update' => array(
		'content' => "Hey, I've just been updated!",
		'author' => 'DO YOU KNOW WHO I AM??? MWAH HAH HAH!',
		'slug' => 'this-is-a-slug'
	)
));
```

**Example 2: Execute a custom query**:

```php
Query::_query('', 'posts', array(
	'custom' => 'UPDATE posts SET content = :content, author = :author, slug = :slug WHERE title = :title',
	'placeholders' => array(
		':content' => "Hey, I've just been updated!",
		':author' => 'DO YOU KNOW WHO I AM??? MWAH HAH HAH',
		':slug' => 'this-is-a-slug',
		':title' => 'A post title'
	)
));
```

**Example 3: Insert values into the database**:

```php
Query::_query('title, content', 'posts', array(
	'action' => 'insert',
	'values' => array(':title', ':content'),
	'placeholders' => array(
		':title' => 'My Post title!',
		':content' => 'My post content'
	)
));
```
## Notes
If the `limit_start` parameter is specified with the `limit_end` parameter, but `limit_end` is set to zero, `::query` won't limit the number of records it returns.

***

To get the value of a specific column from a returned array, use the internal `::get_var` method. 

**API**:

```php
static function get_var( array $results, $index);
```

**Example usage**:

1. Build a custom query to get a post from the database by its title,
2. Execute the query, which will return an array,
3. Use `::get_var` to just return the value of a returned array key.

```php
Query::build('GET: %c', function($post_title) {
	return Query::select_where('title', $post_title, 'posts');
});

// Execute the custom query. Search for the post whose title is 'My first post'

$my_first_post = Query::run('GET: My first post');
$post_title = Query::get_var( $my_first_post, 'title');
$post_body = Query::get_var( $my_first_post, 'content');	
```

## Help & Guidance
Read `make_queries.md` to view the API representation of `::select_where`.  
