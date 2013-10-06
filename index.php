<?php

	include 'Query.php';

	Query::setup(array(
		'database' => 'blog'
	));

	echo ( Query::column_exists('title', 'posts')) ? "Title exists in posts": "Title doesn't exist in post";

?>