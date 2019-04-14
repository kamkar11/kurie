<?php

if(!isset($_GET['id'])){
    header('location: index.php?v=klienci/klienci');
}

$result = $pdo->prepare('DELETE FROM klienci WHERE id_klienta = :id');
$result->bindParam(':id',$_GET['id']);
$result->execute();

// czy jesteś pewny że chcesz usunąć ????????!!!

header('location: index.php?v=klienci/klienci');

 ?>
