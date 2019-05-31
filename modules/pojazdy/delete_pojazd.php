<?php

if(!isset($_GET['id'])){
    header('location: index.php?v=pojazdy/pojazdy');
}
/*
$result = $pdo->prepare('DELETE FROM pojazdy WHERE id_pojazdu = :id');
$result->bindParam(':id',$_GET['id']);
$result->execute();
*/

$stmt = oci_parse($conn, "begin DELETE_POJAZD(:id); end;");

oci_bind_by_name($stmt, ":id",  $_GET['id']);

oci_execute($stmt);


header('location: index.php?v=pojazdy/pojazdy');



 ?>
