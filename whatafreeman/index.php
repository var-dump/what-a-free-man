<?php
require(dirname(__FILE__)."/config/sql.php");

$result = $PDO->query('select * from pro');
$pro = $result->fetchAll(PDO::FETCH_ASSOC);

require(dirname(__FILE__)."/city/selectCity.php");
?>