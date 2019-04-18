<?php

if(!isset($_GET['id'])){
    header('location: index.php?v=pojazdy/pojazdy');
}

$result = $pdo->prepare('DELETE FROM pojazdy WHERE id_pojazdu = :id');
$result->bindParam(':id',$_GET['id']);
$result->execute();

// czy jesteś pewny że chcesz usunąć ????????!!!

header('location: index.php?v=pojazdy/pojazdy');



 ?>
