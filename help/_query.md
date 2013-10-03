# Explore the `::query` method
The `::query` method is Query.php's main query initiator. As you have probably seen in the demo's, it is used to execute queries in different ways. 

**API**:

```php
static function _query($column = '', $table = '', array $extra_options = null);
```

## The `$extra_options` array
It is here where you can modify the query to be executed. The array accepts these **nine** parameters:

1. `action` (string) - The operation to be performed. Defaults to `SELECT`.
2. `where` (string) - The condition of a `WHERE` clause. Write it as is, i.e. write the clause how you would write it in plain SQL - just exclude the 'WHERE' keyword!
3. `placeholders` (array) - Since Query.php utilizes PHP's PDO class, it also carries support for placeholders. Provide an array of placeholders with the key being the placeholder in its form, and its value being the value of the placeholder.
4. `limit_start` (int) - The starting point of the limit. Defaults to **0**.
5. `limit_end` (int) - The maximum number of records to return. Defaults to **0**. 
6. `order_by` (string) - The name of the column whose data should be used to order a set of records.
7. `sort` (string) - The order that records should be displayed in. Defaults to **ASC** (ascending, old to new). Specify **DESC** to show records from new to old.
8. `update` (array) - The columns whose value should be updated. **This should only be specified if the `action` is set to `update`.**
9. `custom` (string) - The SQL code to be executed. **If this key is specified, do NOT provide any more keys as this could result in problems.**

**Example 1: Update columns**:

```php
Query::_query('', 'posts', array(
	'action' => 'update',
	'where' => 'title = :title',
	'placeholders' => array(
		':title' => 'A post title'
	),
	'update' => array(
		'content' => 'Hey, I\'ve just been updated!',
		'author' => 'DO YOU KNOW WHO I AM??? MWAH HAH HAH!',
		'slug' => 'this-is-a-slug'
	)
));
```