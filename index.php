<!DOCTYPE html>
<html>
    <head>
        <title>Playing with Query.php</title>
        <style>
            h1, h2, h3, h4, h5, h6, p {
                font-family: sans-serif;
                font-weight: lighter;
            }


        </style>
    </head>
    <body>
<?php require_once 'Query.php';

Query::setup( array(
	'database' => 'blog'
));

Query::build('Get title: %c', function($post) {
   return Query::select_where('title', ':title', 'posts', '', array(':title' => $post));
});

Query::build('Value of %c for post: %c', function($column, $post) {
   $query = Query::select_where('title', $post, 'posts', $column);
   return Query::get_var( $query, $column);
});

$x = Query::run('Value of description for post: BlogPad Function: process_emots()');

echo <<<EOL
<h1>$x</h1>
EOL;

?>