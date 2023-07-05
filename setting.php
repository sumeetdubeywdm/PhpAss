
<?php 
define('DBNAME','phptest');
define('DBUSER','rootphp');
define('DBPASS','rootphp');
define('DBHOST','localhost');
try {
 $db = 'mysql:host=' .DBHOST . ';dbname=' . DBNAME.';utf8';
  $db= new PDO($db,DBUSER,DBPASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//   echo "page is connected with database successfully..";
} catch(PDOException $e) {
  echo "Issue -> Connection failed: " . $e->getMessage();
}

