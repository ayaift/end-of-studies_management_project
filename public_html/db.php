
<?php

  define('host', 'localhost');

  define('db_name','univ');

  define('user', 'root');

  define('pass', '');

try {

  $link=mysqli_connect("localhost","root","","univ");




} catch (Exception $e) {

  echo $e;

}

 ?>