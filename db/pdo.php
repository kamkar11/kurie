<?php

try {
    $pdo = new PDO("oci:dbname=//localhost:1521/test;charset=UTF8", 'kam', '1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // zwraca tablice assoc

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

 ?>
