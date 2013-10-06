# Query.php support
Here are the error messages you might see Query.php display included with their cause and fix.

## _Oops, it looks like your version of PHP doesn't support custom formatted queries._ 

**Cause:** You are attempting to create custom formatted queries in a version of PHP that's lower than **5.3.0**. For custom formatted queries to work, you'll need to run PHP on at least 5.3.0.

**Fix:** Upgrade your version of PHP to at least version **5.3.0**, or contact your web-host to complete this process for you. 

## _Query.php isn't compatible with your version of PHP. Please upgrade to at least 5.1.0 to continue._

**Cause:** Pretty self explanatory. This error will only be thrown at you if the version of PHP you're running is lower than **5.1.0**.

**Fix:** Upgrade your version of PHP to at least **5.1.0**, or contact your web-host to complete this process for you.

## _Driver is not supported by Query.php._

**Cause:** You are attempting to connect to a database that isn't ran by the MySQL or SQLite database drivers. Query.php (<em>as of October 2013</em>) only holds support for the MySQL and SQlite database drivers.

**Fix:** Migrate your database from the driver that resulted in the error to either MySQL or SQLite. 

## _Query.php requires the PDO module to be installed._

**Cause:** The copy of PHP that you're running doesn't have the PDO module pre-installed.

**Fix:** Provided that the version of PHP that you're running is at least **5.1.0**, follow the instructions [here](http://php.net/manual/en/pdo.installation.php) to install the PDO module. Alternatively, do get into contact with your web-host who should complete this process for you.

## _Unrecognised expression._

**Cause:** You are attempting to run a custom query that hasn't been defined yet.

**Fix:** Use the internal `::build` method to register the custom query that resulted in the error.