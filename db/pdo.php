<?php
/*
try {
    $pdo = new PDO("oci:dbname=//localhost:1521/test;charset=UTF8", 'kam', '1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // zwraca tablice assoc

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
*/


$conn = oci_connect('kam', '1234', 'localhost:1521/test', 'UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
 ?>
